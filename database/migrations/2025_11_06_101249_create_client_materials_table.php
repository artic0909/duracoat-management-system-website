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
        Schema::create('client_materials', function (Blueprint $table) {
            $table->id();
            $table->string('client_unique_id')->unique();
            $table->string('client_name');
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->json('material_details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_materials');
    }
};
