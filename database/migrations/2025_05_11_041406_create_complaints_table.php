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
        Schema::create('complaints', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('complaint_from')->nullable();
            $table->unsignedInteger('complaint_against')->nullable();
            $table->string('title')->nullable();
            $table->dateTime('date')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('pending'); // pending, resolved, closed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
