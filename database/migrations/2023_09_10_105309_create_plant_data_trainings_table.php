<?php

use App\Models\Plant;
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
        Schema::create('plant_data_trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Plant::class);
            $table->foreign('plant_id')->references('id')->on('plants');
            $table->integer('temperature');
            $table->integer('humidity');
            $table->boolean('conclusion');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant_data_trainings');

    }
};
