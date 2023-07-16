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
        Schema::create('amortizations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // $table->foreignId('loans_id')->constrained('loans');

            $table->decimal('amort_principal', 20, 2);
            $table->decimal('amort_interest', 20, 2);

            $table->date('amort_start', 20, 2);
            $table->decimal('amort_end', 20, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amortizations');
    }
};
