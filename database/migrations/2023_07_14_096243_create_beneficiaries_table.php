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
        Schema::create('benificiaries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('member_id')->constrained('members');
            
            $table->string('benificiary_name')->nullable();
            $table->date('birthday')->nullable();
            $table->string('relationship')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
