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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->length(99);
            $table->string('phone')->length(20);
            $table->datetime('dob');
            $table->string('gender')->length(20);
            $table->string('gender')->length(20);
            $table->string('email')->length(55);
            $table->string('password')->length(155);
            $table->string('passport_country')->length(55)->nullable();
            $table->string('passport_no')->length(30)->nullable();
            $table->string('certificate')->length(255)->nullable();
            $table->string('photo')->length(255)->nullable();
            $table->string('cv')->length(255)->nullable();
            $table->string('location_type')->length(155)->nullable();
            $table->string('country')->length(155)->nullable();
            $table->string('city')->length(155)->nullable();
            $table->string('zip_code')->length(20)->nullable();
            $table->string('address')->length(255);
            $table->string('bank_holder')->length(99)->nullable();
            $table->string('bank_account')->length(30)->nullable();
            $table->string('bank_name')->length(99)->nullable();
            $table->string('bank_branch')->length(99)->nullable();
            $table->string('bank_routing')->length(99)->nullable();
            $table->string('employee_id')->length(10);
            $table->integer('company_id')->length(5);
            $table->integer('branch_id')->length(5);
            $table->integer('department_id')->length(5);
            $table->integer('designation_id')->length(5);
            $table->datetime('joining_date')->nullable();
            $table->string('number')->length(55)->nullable();
            $table->string('hour_per_day')->length(8)->nullable();
            $table->string('annual_salary')->length(8)->nullable();
            $table->string('days_per_week')->length(8)->nullable();
            $table->string('fixed_salary')->length(8)->nullable();
            $table->string('hour_per_month')->length(8)->nullable();
            $table->string('rate_per_day')->length(8)->nullable();
            $table->string('days_per_month')->length(8)->nullable();
            $table->string('rate_per_hour')->length(8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
