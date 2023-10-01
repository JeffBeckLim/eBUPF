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
        Schema::create('checks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();  

            $table->foreignId('loan_id')->constrained('loans');

            $table->date('date')->nullable();
            $table->integer('number')->nullable();
            $table->string('voucher_num')->nullable();
            $table->string('payee')->nullable();
            $table->string('nature_of_payment')->nullable();
            
            $table->decimal('gross_amount', 20, 2)->nullable();
            $table->decimal('net_amount', 20, 2)->nullable();

            $table->decimal('adjusted_net_pay', 20, 2)->nullable();

            $table->string('remarks')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checks');
    }
};
