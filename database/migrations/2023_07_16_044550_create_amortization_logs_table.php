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
        Schema::create('amortization_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('amortization_id')->constrained('amortizations');
            
            $table->decimal('log_amort_principal', 20, 2);
            $table->decimal('log_amort_interest', 20, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amortization_logs');
    }
};
