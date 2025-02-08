<?php

namespace App\Factories;

use App\Models\Campaign;
use App\Discounts\Contracts\DiscountHandlerInterface;
use App\Discounts\PercentageDiscountHandler;
use App\Discounts\BuyXGetYFreeDiscountHandler;
use App\Discounts\CheapestItemDiscountHandler;

class DiscountHandlerFactory
{
    /**
     *
     * @var array<string, class-string<DiscountHandlerInterface>>
     */
    protected array $handlerMapping = [
        'percentage'  => PercentageDiscountHandler::class,
        'buy_x_get_y' => BuyXGetYFreeDiscountHandler::class,
        'cheapest'    => CheapestItemDiscountHandler::class,
    ];

    /**
     * Verilen kampanyaya uygun discount handler'ı üretir.
     *
     * @param Campaign $campaign
     * @return DiscountHandlerInterface|null
     */
    public function makeHandler(Campaign $campaign): ?DiscountHandlerInterface
    {
        $type = $campaign->type;
        if ($type) {
            $key = $type->value;
            if (isset($this->handlerMapping[$key])) {
                $handlerClass = $this->handlerMapping[$key];
                return new $handlerClass($campaign);
            }
        }
        return null;
    }
}
