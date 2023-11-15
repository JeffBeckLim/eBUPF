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

            $table->integer('loan_id_log')->nullable();
            $table->string('loan_code_log')->nullable();

            $table->integer('amortization_id_log')->nullable();
            
            $table->decimal('amort_principal_log', 20, 2)->nullable();
            $table->decimal('amort_interest_log', 20, 2)->nullable();

            $table->date('amort_start_log')->nullable();
            $table->date('amort_end_log')->nullable();

            $table->string('changes')->nullable();
            $table->integer('updated_by')->nullable();
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
