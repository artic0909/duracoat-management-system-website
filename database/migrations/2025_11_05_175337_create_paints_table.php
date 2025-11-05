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
        Schema::create('paints', function (Blueprint $table) {
            $table->id();
            $table->string('paint_unique_id')->unique();
            $table->string('brand_name')->nullable();
            $table->string('ral_code')->nullable();
            $table->string('shade_name')->nullable();
            $table->string('finish')->nullable();
            $table->decimal('quantity', 10, 2)->nullable();
            $table->string('status')->default('in stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paints');
    }
};
