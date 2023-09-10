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
        Schema::create('loan_application_statuses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('loan_application_state_id')->constrained('loan_application_states');
            $table->foreignId('loan_id')->constrained('loans');

            $table->date('date_evaluated');
            $table->text('remarks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_application_statuses');
    }
};
