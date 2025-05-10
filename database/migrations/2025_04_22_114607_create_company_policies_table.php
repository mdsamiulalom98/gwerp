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
        Schema::create('company_policies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->length(5);
            $table->integer('branch_id')->length(5);
            $table->string('title')->length(255);
            $table->longtext('file');
            $table->longtext('description')->nullable();
            $table->tinyInteger('status')->length(2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_policies');
    }
};
