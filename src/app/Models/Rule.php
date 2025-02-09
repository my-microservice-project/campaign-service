<?php

namespace App\Models;

use App\Enums\RuleOperatorEnum;
use App\Enums\RuleTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'rule_type',
        'operator',
        'value'
    ];

    protected $casts = [
        'rule_type' => RuleTypeEnum::class,
        'operator' => RuleOperatorEnum::class
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
}
