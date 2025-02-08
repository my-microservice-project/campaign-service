<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\RuleTypeEnum;
use App\Enums\RuleOperatorEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rule extends Model
{
    protected $fillable = [
        'campaign_id',
        'type',
        'operator',
        'value',
        'additional_data',
    ];

    protected $casts = [
        'additional_data' => 'array',
        'type'            => RuleTypeEnum::class,
        'operator'        => RuleOperatorEnum::class,
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
}
