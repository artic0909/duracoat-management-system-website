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
        Schema::create('jobcard_tests', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('jobcard_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('client_id');

            // Test Date
            $table->date('test_date');

            // Store multiple test records (as JSON array)
            $table->json('testing')->nullable(); //testing(array ->[test_name, test_value, test_result]), 

            $table->timestamps();

            // Optional: add foreign key constraints
            $table->foreign('jobcard_id')->references('id')->on('jobcards')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('client_materials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobcard_tests');
    }
};
