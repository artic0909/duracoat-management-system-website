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
        Schema::create('jobcards', function (Blueprint $table) {
            $table->id();

            // Foreign references
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('client_id');

            // Jobcard details
            $table->date('jobcard_creation_date');
            $table->string('jobcard_number')->unique();

            // Material details
            $table->string('material_type');
            $table->string('material_name');
            $table->decimal('material_quantity', 10, 2);
            $table->string('material_unit');

            // Paint details
            $table->string('paint_id')->nullable();
            $table->string('ral_code')->nullable();
            $table->string('paint_used')->nullable();

            // Status and process dates
            $table->enum('jobcard_status', ['pending', 'pre-treatment', 'powder-applied', 'delivered'])->default('pending');
            $table->date('pre_treatment_date')->nullable();
            $table->date('powder_apply_date')->nullable();
            $table->date('delivery_date')->nullable();

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('client_materials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobcards');
    }
};
