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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->length(8)->index();
            $table->integer('company_id')->length(8)->index();
            $table->integer('branch_id')->length(8)->index();
            $table->integer('department_id')->length(8)->index();
            $table->datetime('date');
            $table->longtext('description')->nullable();
            $table->tinyInteger('status')->length(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
