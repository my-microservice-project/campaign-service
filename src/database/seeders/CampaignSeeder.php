<?php

namespace Database\Seeders;

use App\Enums\CampaignStatusEnum;
use App\Enums\CampaignTypeEnum;
use App\Models\Campaign;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Kampanya 1: Sepet Toplamına %10 İndirim – yüzde kampanyası
        Campaign::create([
            'name'        => 'Sepet Toplamına %10 İndirim',
            'description' => 'Toplam 1000TL ve üzerinde alışveriş yapan bir müşteri, siparişin tamamından %10 indirim kazanır.',
            'start_date'  => $now,
            'end_date'    => $now->copy()->addMonths(3),
            'status'      => CampaignStatusEnum::ACTIVE->getValue(),
            'priority'    => 1,
            'type'        => CampaignTypeEnum::PERCENTAGE->getValue(),
        ]);

        // Kampanya 2: 6 Al 1 Bedava – buy_x_get_y kampanyası
        Campaign::create([
            'name'        => '6 Al 1 Bedava',
            'description' => "2 ID'li kategoriye ait bir üründen 6 adet satın alındığında, bir tanesi ücretsiz olarak verilir.",
            'start_date'  => $now,
            'end_date'    => $now->copy()->addMonths(3),
            'status'      => CampaignStatusEnum::ACTIVE->getValue(),
            'priority'    => 2,
            'type'        => CampaignTypeEnum::BUY_X_GET_Y->getValue(),
        ]);

        // Kampanya 3: En Ucuza %20 İndirim – cheapest kampanyası
        Campaign::create([
            'name'        => 'En Ucuza %20 İndirim',
            'description' => "1 ID'li kategoriden iki veya daha fazla ürün satın alındığında, en ucuz ürüne %20 indirim yapılır.",
            'start_date'  => $now,
            'end_date'    => $now->copy()->addMonths(3),
            'status'      => CampaignStatusEnum::ACTIVE->getValue(),
            'priority'    => 3,
            'type'        => CampaignTypeEnum::CHEAPEST->getValue(),
        ]);
    }
}
