<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
