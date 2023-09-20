<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function hardwares(): HasMany
    {
        return $this->hasMany(Hardware::class);
    }

    public function plantDataTrainings(): HasMany
    {
        return $this->hasMany(PlantDataTraining::class);
    }
}
