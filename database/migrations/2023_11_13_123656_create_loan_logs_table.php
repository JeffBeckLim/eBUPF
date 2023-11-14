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
        Schema::create('loan_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('loan_id_log')->nullable();
            $table->string('loan_code_log')->nullable();

            $table->string('loan_category_log')->nullable();
            $table->string('loan_type_log')->nullable();

            $table->decimal('principal_amount_log', 20, 2)->nullable();
            $table->decimal('interest_log', 20, 2)->nullable();
            $table->integer('is_active_log')->nullable();
            $table->integer('term_years_log')->nullable();
            $table->timestamp('deleted_at_log')->nullable();

            $table->string('create_update_or_delete')->nullable();
            $table->integer('updated_by')->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_logs');
    }
};
