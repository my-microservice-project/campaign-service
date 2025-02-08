<?php

namespace Database\Seeders;

use App\Enums\RuleOperatorEnum;
use App\Enums\RuleTypeEnum;
use App\Models\Campaign;
use App\Models\Rule;
use Illuminate\Database\Seeder;

class RuleSeeder extends Seeder
{
    public function run(): void
    {
        $campaign1 = Campaign::where('name', 'Sepet Toplamına %10 İndirim')->first();
        if ($campaign1) {
            Rule::create([
                'campaign_id'     => $campaign1->id,
                'type'            => RuleTypeEnum::CART_AMOUNT->getValue(),
                'operator'        => RuleOperatorEnum::GREATER_OR_EQUAL->getValue(),
                'value'           => '1000',
                'additional_data' => null,
            ]);
        }

        $campaign2 = Campaign::where('name', '6 Al 1 Bedava')->first();
        if ($campaign2) {
            Rule::create([
                'campaign_id'     => $campaign2->id,
                'type'            => RuleTypeEnum::PRODUCT_QUANTITY->getValue(),
                'operator'        => RuleOperatorEnum::GREATER_OR_EQUAL->getValue(),
                'value'           => '6',
                'additional_data' => null,
            ]);
        }

        $campaign3 = Campaign::where('name', 'En Ucuza %20 İndirim')->first();
        if ($campaign3) {
            Rule::create([
                'campaign_id'     => $campaign3->id,
                'type'            => RuleTypeEnum::PRODUCT_QUANTITY->getValue(),
                'operator'        => RuleOperatorEnum::GREATER_OR_EQUAL->getValue(),
                'value'           => '2',
                'additional_data' => ['apply_to' => 'category'],
            ]);
        }
    }
}
