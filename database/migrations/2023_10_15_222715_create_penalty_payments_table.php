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
        Schema::create('penalty_payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('member_id')->constrained('members');
            $table->foreignId('penalty_id')->constrained('penalties');

            $table->decimal('penalty_payment_amount', 20, 2)->nullable();
            $table->date('payment_date')->nullable();

            $table->integer('or_number')->nullable();
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalty_payments');
    }
};
