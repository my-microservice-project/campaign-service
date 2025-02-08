<?php

namespace App\Actions;

use App\Data\CartDTO;
use App\Factories\DiscountHandlerFactory;
use App\Models\Campaign;
use Illuminate\Pipeline\Pipeline;

class CalculateDiscountAction
{
    public function execute(CartDTO $cart): CartDTO
    {
        // Kampanyaları veritabanından çekiyoruz (veya cache’den, HTTP Client vs. ile)
        $campaigns = Campaign::all();

        // DiscountHandlerFactory örneğini oluşturuyoruz.
        $factory = new DiscountHandlerFactory();

        // Kampanyalar üzerinden dönüp, uygun handler'ları factory ile üretiyoruz.
        $handlers = $campaigns->map(function ($campaign) use ($factory) {
            return $factory->makeHandler($campaign);
        })->filter();

        // Laravel Pipeline ile her handler'ı sırasıyla çalıştırıyoruz.
        return app(Pipeline::class)
            ->send($cart)
            ->through($handlers->all())
            ->thenReturn();
    }
}
