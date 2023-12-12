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
        Schema::create('penalty_payment_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('member_id_log')->nullable();
            $table->integer('penalty_id_log')->nullable();

            $table->decimal('penalty_payment_amount_log', 20, 2)->nullable();
            $table->date('payment_date_log')->nullable();

            $table->integer('or_number_log')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalty_payment_logs');
    }
};
