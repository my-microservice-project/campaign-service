<?php

return [
    'steps' => [
        App\Pipelines\Pipes\AssignCategoryToCartItemsPipe::class,
        App\Pipelines\Pipes\ApplyCampaignsPipe::class,
        App\Pipelines\Pipes\CalculateFinalTotalPipe::class,
    ],
];

