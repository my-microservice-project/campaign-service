<?php

namespace App\Pipelines\Pipes;

use App\Exceptions\InvalidCampaignTypeException;
use App\Factories\CampaignProcessorFactory;
use App\Repositories\Contracts\CampaignRepositoryInterface;
use App\Data\CampaignResultDTO;
use App\Data\CartDTO;
use Closure;
use Throwable;

class ApplyCampaignsPipe
{
    public function __construct(
        protected CampaignRepositoryInterface $campaignRepository
    ) {}

    /**
     * @throws Throwable
     */
    public function handle(CartDTO $cart, Closure $next)
    {
        // Aktif kampanyaları repository üzerinden al.
        $campaigns = $this->campaignRepository->getActiveCampaigns();

        // Uygulanan kampanyaları toplamak için geçici bir koleksiyon oluşturuyoruz.
        $appliedCampaigns = collect();

        // Her kampanya için tipine uygun processor’ı elde edip iş mantığını çalıştırıyoruz.
        foreach ($campaigns as $campaign) {

            $processor = CampaignProcessorFactory::make($campaign->type);

            throw_if($processor === null, new InvalidCampaignTypeException());

            $applied = $processor->process($campaign, $cart);

            if(!$applied) {
                continue;
            }

            $appliedCampaigns->push($applied);

        }

        $campaignResult = new CampaignResultDTO($appliedCampaigns);

        return $next(['cart' => $cart, 'campaignResult' => $campaignResult]);
    }
}
