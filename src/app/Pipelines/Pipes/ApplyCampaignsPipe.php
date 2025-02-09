<?php
declare(strict_types=1);

namespace App\Pipelines\Pipes;

use App\Contracts\CampaignPipeInterface;
use App\Data\Campaign\AppliedCampaignDTO;
use App\Data\Campaign\CampaignCalculationPayloadDTO;
use App\Data\Campaign\CampaignResultDTO;
use App\Data\Cart\CartDTO;
use App\Exceptions\InvalidCampaignTypeException;
use App\Factories\CampaignProcessorFactory;
use App\Repositories\Contracts\CampaignRepositoryInterface;
use Closure;
use Illuminate\Support\Collection;
use Throwable;

class ApplyCampaignsPipe implements CampaignPipeInterface
{
    public function __construct(
        protected CampaignRepositoryInterface $campaignRepository
    )
    {
    }

    /**
     * @throws InvalidCampaignTypeException
     * @throws Throwable
     */
    public function handle(CampaignCalculationPayloadDTO $payload, Closure $next): CampaignCalculationPayloadDTO
    {
        $appliedCampaigns = $this->processCampaigns($payload->cart);

        $payload->campaignResult = new CampaignResultDTO($appliedCampaigns);

        return $next($payload);
    }

    /**
     * @param CartDTO $cart
     * @return Collection<int, AppliedCampaignDTO>
     * @throws InvalidCampaignTypeException
     * @throws Throwable
     */
    protected function processCampaigns(CartDTO $cart): Collection
    {
        $campaigns = $this->campaignRepository->getActiveCampaigns();
        $appliedCampaigns = collect();

        $campaigns->sortByDesc('priority')
            ->each(function ($campaign) use ($cart, &$appliedCampaigns) {
                if (!$this->isCampaignCompatible($campaign, $appliedCampaigns)) {
                    return;
                }

                $processedCampaigns = $this->applyCampaign($campaign, $cart);

                if ($processedCampaigns->isEmpty()) {
                    return;
                }

                $appliedCampaigns = $appliedCampaigns->merge($processedCampaigns);
            });

        return $appliedCampaigns;
    }

    /**
     * Kampanyanın, daha önce uygulanan kampanyalarla uyumlu olup olmadığını kontrol eder.
     */
    protected function isCampaignCompatible($campaign, Collection $appliedCampaigns): bool
    {
        return $appliedCampaigns->every(function ($appliedCampaign) use ($campaign) {
            return $campaign->isCompatibleWith($appliedCampaign->campaign);
        });
    }

    /**
     * Kampanyayı uygular ve sonucu döndürür.
     *
     * @throws InvalidCampaignTypeException
     * @throws Throwable
     */
    protected function applyCampaign($campaign, CartDTO $cart): Collection
    {
        $processor = CampaignProcessorFactory::make($campaign->type);
        throw_if($processor === null, InvalidCampaignTypeException::class);

        return $processor->process($campaign, $cart);
    }
}
