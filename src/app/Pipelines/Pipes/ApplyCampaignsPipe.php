<?php
declare(strict_types=1);

namespace App\Pipelines\Pipes;

use App\Data\AppliedCampaignDTO;
use App\Exceptions\InvalidCampaignTypeException;
use App\Factories\CampaignProcessorFactory;
use App\Repositories\Contracts\CampaignRepositoryInterface;
use App\Data\CampaignResultDTO;
use App\Data\CampaignCalculationPayloadDTO;
use Closure;
use Illuminate\Support\Collection;
use App\Data\CartDTO;
use Throwable;

class ApplyCampaignsPipe
{
    public function __construct(
        protected CampaignRepositoryInterface $campaignRepository
    ) {}

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

        $campaigns->each(function ($campaign) use ($cart, &$appliedCampaigns) {
            $processor = CampaignProcessorFactory::make($campaign->type);

            throw_if($processor === null, new InvalidCampaignTypeException());

            $results = $processor->process($campaign, $cart);

            if($results->isEmpty()) return;

            $appliedCampaigns = $appliedCampaigns->merge($results);
        });

        return $appliedCampaigns;
    }
}
