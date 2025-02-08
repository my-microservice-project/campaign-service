<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\TargetTypeEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Target extends Model
{
    protected $fillable = [
        'campaign_id',
        'target_type',
        'target_id',
        'additional_data',
    ];

    protected $casts = [
        'additional_data' => 'array',
        'target_type'     => TargetTypeEnum::class,
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
}
