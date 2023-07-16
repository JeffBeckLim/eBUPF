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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('campus_id')->nullable()->constrained('campuses', 'id'); //none
            $table->foreignId('unit_id')->nullable()->constrained('units', 'id'); //none

            $table->foreignId('user_id')->constrained('users', 'id');
        
            $table->string('firstname');
            $table->string('lastname');
            $table->integer('agree_to_terms');
            
            // Membership form data
            $table->string('middle_initials')->nullable();
            $table->string('contact_num')->nullable();
            $table->string('address')->nullable();
            $table->date('birthday')->nullable();
            $table->string('tin_num')->nullable();
            $table->string('position')->nullable();

            // $table->timestamp('created_at')->useCurrent(); GENERATED
            $table->timestamp('verified_at')->nullable();
            // $table->timestamp('updated_at')->nullable(); GENERATED
            $table->timestamp('disabled_at')->nullable();
            
            $table->string('employee_num')->nullable();
            $table->date('bu_appointment_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
