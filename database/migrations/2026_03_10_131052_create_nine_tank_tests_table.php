<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nine_tank_tests', function (Blueprint $table) {
            $table->id();

            // Meta
            $table->date('testing_date');
            $table->string('jobcard_no')->nullable();

            // Tank 1 — Apdeg-60 (De-greasing)
            $table->string('t1_chemical_name')->default('Apdeg-60');
            $table->string('t1_testing_value')->nullable();
            $table->string('t1_result')->nullable();
            $table->string('t1_need_chemical')->nullable();   // need chemical (kg)

            // Tank 2 — Water (Rinse)
            $table->string('t2_chemical_name')->default('Water');
            $table->string('t2_testing_value')->nullable();
            $table->string('t2_result')->nullable();
            $table->string('t2_need_attention')->nullable();  // need attention

            // Tank 3 — Aprust-21 (Rust Remover)
            $table->string('t3_chemical_name')->default('Aprust-21');
            $table->string('t3_testing_value')->nullable();
            $table->string('t3_result')->nullable();
            $table->string('t3_need_chemical')->nullable();   // need chemical (kg)

            // Tank 4 — Water (Rinse)
            $table->string('t4_chemical_name')->default('Water');
            $table->string('t4_testing_value')->nullable();
            $table->string('t4_result')->nullable();
            $table->string('t4_need_attention')->nullable();  // need attention

            // Tank 5 — S-101 (Surface Treatment)
            $table->string('t5_chemical_name')->default('S-101');
            $table->string('t5_testing_value')->nullable();
            $table->string('t5_result')->nullable();
            $table->string('t5_need_attention')->nullable();  // need attention

            // Tank 6 — Act-505 (Activator)
            $table->string('t6_chemical_name')->default('Act-505');
            $table->string('t6_testing_value')->nullable();
            $table->string('t6_result')->nullable();
            $table->string('t6_need_attention')->nullable();  // need attention

            // Tank 7 — Aphox-ZC (Phosphating)
            $table->string('t7_chemical_name')->default('Aphox-ZC');
            $table->string('t7_testing_value')->nullable();
            $table->string('t7_need_level')->nullable();
            $table->string('t7_result')->nullable();
            $table->string('t7_need_chemical')->nullable();   // need chemical (kg)

            // Tank 8 — Water (Rinse)
            $table->string('t8_chemical_name')->default('Water');
            $table->string('t8_testing_value')->nullable();
            $table->string('t8_result')->nullable();
            $table->string('t8_need_attention')->nullable();  // need attention

            // Tank 9 — Passeal-1 (Passivation)
            $table->string('t9_chemical_name')->default('Passeal-1');
            $table->string('t9_testing_value')->nullable();
            $table->string('t9_result')->nullable();
            $table->string('t9_need_attention')->nullable();  // need attention

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nine_tank_tests');
    }
};
