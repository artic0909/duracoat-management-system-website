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
        Schema::table('jobcards', function (Blueprint $table) {
            $table->string('min_micron')->nullable()->after('material_unit');
            $table->string('max_micron')->nullable()->after('min_micron');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobcards', function (Blueprint $table) {
            $table->dropColumn(['min_micron', 'max_micron']);
        });
    }
};
