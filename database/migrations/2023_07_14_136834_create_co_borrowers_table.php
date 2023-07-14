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
        Schema::create('co_borrowers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('members_id')->constrained('members');
            // $table->foreignId('loans_id')->constrained('loans');

            $table->integer('accept_request')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('co_borrowers');
    }
};
