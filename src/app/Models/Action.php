<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ActionTypeEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Action extends Model
{
    protected $fillable = [
        'campaign_id',
        'type',
        'value',
        'min_affected_items',
        'max_affected_items',
        'max_discount_amount',
        'additional_data',
        'priority',
    ];

    protected $casts = [
        'additional_data' => 'array',
        'type'            => ActionTypeEnum::class,
        'value'           => 'decimal:2',
        'max_discount_amount' => 'decimal:2',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
}
