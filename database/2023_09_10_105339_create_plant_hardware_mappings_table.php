<?php

use App\Models\Plant;
use App\Models\Hardware;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plant_hardware_mappings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Plant::class);
            $table->foreign('plant_id')->references('id')->on('plants');
            $table->foreignIdFor(Hardware::class);
            $table->foreign('hardware_id')->references('id')->on('hardware');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant_hardware_mappings');
    }
};
