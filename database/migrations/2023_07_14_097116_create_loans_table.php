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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('member_id')->constrained('members');

            //nullable for now but this has to be filled
            $table->foreignId('loan_type_id')->nullable()->constrained('loan_types');

            $table->foreignId('amortization_id')->nullable()->constrained('amortizations');
            $table->foreignId('adjustment_id')->nullable()->constrained('adjustments');
            $table->foreignId('loan_category_id')->nullable()->constrained('loan_categories');

            $table->decimal('principal_amount', 20, 2);
            $table->decimal('original_principal_amount', 20, 2)->nullable(); //this is the original amount requested for reference and cannot be modified

            $table->decimal('interest', 20, 2)->nullable();

            $table->integer('term_years');

            $table->integer('is_visible')->nullable();
            $table->integer('is_active')->nullable();

            $table->timestamp('is_viewed')->nullable();
            // campus_id_index not added 
            // units_id_index not added 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
