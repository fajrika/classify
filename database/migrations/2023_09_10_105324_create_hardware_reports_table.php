<?php

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
        Schema::create('hardware_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Hardware::class);
            $table->foreign('hardware_id')->references('id')->on('hardware');
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
        Schema::dropIfExists('hardware_reports');
    }
};
