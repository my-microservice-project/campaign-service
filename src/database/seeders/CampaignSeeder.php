<?php

namespace Database\Seeders;

use App\Enums\ActionTypeEnum;
use App\Enums\CampaignStatusEnum;
use App\Enums\CampaignTypeEnum;
use App\Enums\RuleOperatorEnum;
use App\Enums\RuleTypeEnum;
use Illuminate\Database\Seeder;
use App\Models\Campaign;

class CampaignSeeder extends Seeder
{
    public function run()
    {
        // Kampanya 1:
        // "Toplam 1000TL ve üzerinde alışveriş yapan bir müşteri, siparişin tamamından %10 indirim kazanır."
        $campaign1 = Campaign::create([
            'name'        => '10_PERCENT_OVER_1000',
            'type'        => CampaignTypeEnum::ORDER_TOTAL_DISCOUNT->getValue(),
            'description' => 'Toplam 1000 TL ve üzeri alışveriş yapan müşterilere %10 indirim uygulanır.',
            'active'      => CampaignStatusEnum::ACTIVE->getValue(),
            'priority'    => 1,
            'start_at'    => now(),
            'end_at'      => now()->addMonth(),
        ]);

        // Kampanya 1 için kural: min_total >= 1000
        $campaign1->rules()->create([
            'rule_type' => RuleTypeEnum::MIN_TOTAL->getValue(),
            'operator'  => RuleOperatorEnum::GREATER_OR_EQUAL->getValue(),
            'value'     => 1000
        ]);

        // Kampanya 1 için aksiyon: %10 indirim
        $campaign1->actions()->create([
            'action_type' => ActionTypeEnum::DISCOUNT_PERCENTAGE->getValue(),
            'value'       => 10
        ]);

        // Kampanya 2:
        // "2 ID'li kategoriye ait bir üründen 6 adet satın alındığında, bir tanesi ücretsiz olarak verilir."
        $campaign2 = Campaign::create([
            'name'        => 'BUY_5_GET_1',
            'type'        => CampaignTypeEnum::BUY_X_GET_Y_FREE->getValue(),
            'description' => '2 numaralı kategorideki ürünlerden 6 adet alana 1 adet ücretsiz verilir.',
            'active'      => CampaignStatusEnum::ACTIVE->getValue(),
            'priority'    => 2,
            'start_at'    => now(),
            'end_at'      => now()->addMonth(),
        ]);

        // Kampanya 2 için kural 1: category_id == 2
        $campaign2->rules()->create([
            'rule_type' => RuleTypeEnum::CATEGORY_ID->getValue(),
            'operator'  => RuleOperatorEnum::EQUAL->getValue(),
            'value'     => 2
        ]);
        // Kampanya 2 için kural 2: min_quantity >= 6
        $campaign2->rules()->create([
            'rule_type' => RuleTypeEnum::MIN_QUANTITY->getValue(),
            'operator'  => RuleOperatorEnum::GREATER_OR_EQUAL->getValue(),
            'value'     => 6
        ]);

        // Kampanya 2 için aksiyon: 1 adet ücretsiz ürün
        $campaign2->actions()->create([
            'action_type' => ActionTypeEnum::FREE_PRODUCT_QUANTITY->getValue(),
            'value'       => 1
        ]);

        // Kampanya 3:
        // "1 ID'li kategoriden iki veya daha fazla ürün satın alındığında, en ucuz ürüne %20 indirim yapılır."
        $campaign3 = Campaign::create([
            'name'        => 'BUY_2_PLUS_GET_20_PERCENT',
            'type'        => CampaignTypeEnum::CATEGORY_DISCOUNT->getValue(),
            'description' => '1 numaralı kategoriden 2 veya daha fazla ürün alındığında, en ucuz ürüne %20 indirim uygulanır.',
            'active'      => CampaignStatusEnum::ACTIVE->getValue(),
            'priority'    => 3,
            'start_at'    => now(),
            'end_at'      => now()->addMonth(),
        ]);

        // Kampanya 3 için kural 1: category_id == 1
        $campaign3->rules()->create([
            'rule_type' => RuleTypeEnum::CATEGORY_ID->getValue(),
            'operator'  => RuleOperatorEnum::EQUAL->getValue(),
            'value'     => 1
        ]);
        // Kampanya 3 için kural 2: min_quantity >= 2
        $campaign3->rules()->create([
            'rule_type' => RuleTypeEnum::MIN_QUANTITY->getValue(),
            'operator'  => RuleOperatorEnum::GREATER_OR_EQUAL->getValue(),
            'value'     => 2
        ]);

        // Kampanya 3 için aksiyon: %20 indirim
        $campaign3->actions()->create([
            'action_type' => ActionTypeEnum::DISCOUNT_PERCENTAGE->getValue(),
            'value'       => 20
        ]);
    }
}
