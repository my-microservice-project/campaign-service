<?php

namespace App\Models;

use App\Enums\ActionTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'action_type',
        'value'
    ];

    protected $casts = [
        'action_type' => ActionTypeEnum::class,
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
}
