<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $name
 * @property string $type
 * @property string $description
 * @property integer $active
 * @property Carbon $start_at
 * @property Carbon $end_at
 * @property integer $priority
 * @property Rule[] $rules
 * @property Action[] $actions
 * @property Campaign[] $incompatibleCampaigns
 * @property integer $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'active',
        'start_at',
        'end_at',
        'priority'
    ];

    protected $dates = [
        'start_at',
        'end_at',
    ];

    public function rules(): HasMany
    {
        return $this->hasMany(Rule::class);
    }

    public function actions(): HasMany
    {
        return $this->hasMany(Action::class);
    }

    public function incompatibleCampaigns(): BelongsToMany
    {
        return $this->belongsToMany(
            Campaign::class,
            'incompatible_campaigns',
            'campaign_id',
            'incompatible_campaign_id'
        )->withTimestamps();
    }

    public function isCompatibleWith(Campaign $campaign): bool
    {
        return !$this->incompatibleCampaigns()->where('incompatible_campaign_id', $campaign->id)->exists();
    }
}
