<?php

namespace Database\Seeders;

use App\Enums\TargetTypeEnum;
use App\Models\Campaign;
use App\Models\Target;
use Illuminate\Database\Seeder;

class TargetSeeder extends Seeder
{
    public function run(): void
    {
        $campaign1 = Campaign::where('name', 'Sepet Toplamına %10 İndirim')->first();
        if ($campaign1) {
            $campaign1->targets()->saveMany([
                new Target([
                    'target_type'     => TargetTypeEnum::CART->getValue(),
                    'target_id'       => null,
                    'additional_data' => null,
                ]),
            ]);
        }

        $campaign2 = Campaign::where('name', '6 Al 1 Bedava')->first();
        if ($campaign2) {
            $campaign2->targets()->saveMany([
                new Target([
                    'target_type'     => TargetTypeEnum::CATEGORY->getValue(),
                    'target_id'       => 2,
                    'additional_data' => json_encode(['buy' => 6, 'get' => 1]),
                ]),
            ]);
        }

        $campaign3 = Campaign::where('name', 'En Ucuza %20 İndirim')->first();
        if ($campaign3) {
            $campaign3->targets()->saveMany([
                new Target([
                    'target_type'     => TargetTypeEnum::CATEGORY->getValue(),
                    'target_id'       => 1,
                    'additional_data' => null,
                ]),
            ]);
        }
    }
}
