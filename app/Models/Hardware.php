<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hardware extends Model
{
    use HasFactory;
    public function plant(): BelongsTo
    {
        return $this->BelongsTo(Plant::class);
    }
    public function hardwareReports(): HasMany
    {
        return $this->hasMany(HardwareReport::class);
    }
}
