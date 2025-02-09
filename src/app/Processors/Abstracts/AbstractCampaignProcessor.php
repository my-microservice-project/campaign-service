<?php
declare(strict_types=1);

namespace App\Processors\Abstracts;

use App\Data\Campaign\AppliedCampaignDTO;
use App\Data\Cart\CartDTO;
use App\Models\Campaign;
use App\Processors\Contracts\CampaignProcessorInterface;
use Illuminate\Support\Collection;

abstract class AbstractCampaignProcessor implements CampaignProcessorInterface
{
    protected string $actionType;

    final public function process(Campaign $campaign, CartDTO $cart): Collection
    {

        $eligibleItems = $this->validateRules($campaign, $cart);

        $actions = $this->getActions($campaign);

        return $eligibleItems->flatMap(function (object $payload) use ($actions, $campaign): Collection {

            return $actions->map(function (object $action) use ($payload): ?object {
                return $this->calculateDiscount($payload, $action);
            })->filter();

        })->map(function (object $discountDetails) use ($campaign): AppliedCampaignDTO {

            return new AppliedCampaignDTO(
                campaignName: $campaign->name,
                campaignType: $campaign->type,
                discountDetails: $discountDetails,
                campaign: $campaign
            );

        });
    }

    /**
     * @return Collection<int, object>
     */
    abstract protected function validateRules(Campaign $campaign, CartDTO $cart): Collection;

    protected function getActions(Campaign $campaign): Collection
    {
        return $campaign->actions()
            ->where('action_type', $this->actionType)
            ->get() ?? collect();
    }

    /**
     * @param object $payload
     * @param object $action
     * @return object|null
     */
    abstract protected function calculateDiscount(object $payload, object $action): ?object;
}
