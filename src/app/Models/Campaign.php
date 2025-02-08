<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\CampaignStatusEnum;
use App\Enums\CampaignTypeEnum;

/**
 * @property mixed $type
 */
class Campaign extends Model
{
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'priority',
        'type',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
        'status'        => CampaignStatusEnum::class,
        'type'           => CampaignTypeEnum::class,
    ];

    public function actions(): HasMany
    {
        return $this->hasMany(Action::class);
    }

    public function rules(): HasMany
    {
        return $this->hasMany(Rule::class);
    }

    public function targets(): HasMany
    {
        return $this->hasMany(Target::class);
    }
}
