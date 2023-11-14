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

            $table->integer('loan_id_log',)->nullable();
            $table->string('loan_code_log',)->nullable();

            $table->integer('adjustments_id_log')->nullable();

            $table->string('log_col_name')->nullable();
            $table->string('changes')->nullable();

            $table->integer('updated_by')->nullable();

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
