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
        Schema::create('penalties', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('loan_id')->nullable()->constrained('loans');

            $table->decimal('penalty_total', 20, 2)->nullable();
            $table->integer('penalized_month')->nullable();
            $table->integer('penalized_year')->nullable();

            $table->decimal('penalty_rate', 20, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalties');
    }
};
