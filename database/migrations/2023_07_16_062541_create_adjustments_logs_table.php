<?php

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
        Schema::create('adjustments_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('adjustments_id')->constrained('adjustments');

            $table->string('log_col_name');
            $table->string('changes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adjustments_logs');
    }
};
