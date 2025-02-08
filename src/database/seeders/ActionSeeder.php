<?php

namespace Database\Seeders;

use App\Enums\ActionTypeEnum;
use App\Models\Action;
use App\Models\Campaign;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    public function run(): void
    {
        $campaign1 = Campaign::where('name', 'Sepet Toplamına %10 İndirim')->first();
        if ($campaign1) {
            Action::create([
                'campaign_id'        => $campaign1->id,
                'type'               => ActionTypeEnum::PERCENTAGE_DISCOUNT->getValue(),
                'value'              => 10.00,
                'min_affected_items' => null,
                'max_affected_items' => null,
                'max_discount_amount'=> null,
                'additional_data'    => null,
                'priority'           => 0,
            ]);
        }

        $campaign2 = Campaign::where('name', '6 Al 1 Bedava')->first();
        if ($campaign2) {
            Action::create([
                'campaign_id'        => $campaign2->id,
                'type'               => ActionTypeEnum::PERCENTAGE_DISCOUNT->getValue(),
                'value'              => 100.00,
                'min_affected_items' => 1,
                'max_affected_items' => 1,
                'max_discount_amount'=> null,
                'additional_data'    => null,
                'priority'           => 0,
            ]);
        }

        $campaign3 = Campaign::where('name', 'En Ucuza %20 İndirim')->first();
        if ($campaign3) {
            Action::create([
                'campaign_id'        => $campaign3->id,
                'type'               => ActionTypeEnum::PERCENTAGE_DISCOUNT->getValue(),
                'value'              => 20.00,
                'min_affected_items' => 1,
                'max_affected_items' => 1,
                'max_discount_amount'=> null,
                'additional_data'    => ['apply_to' => 'cheapest'],
                'priority'           => 0,
            ]);
        }
    }
}
