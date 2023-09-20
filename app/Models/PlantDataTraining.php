<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlantDataTraining extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function plant(): BelongsTo
    {
        return $this->belongsTo(Plant::class);
    }
}
