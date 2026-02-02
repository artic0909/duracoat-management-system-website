<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // This will add 'delivery-statement' to the enum WITHOUT changing existing values
        DB::statement("ALTER TABLE `jobcards` MODIFY `jobcard_status` ENUM('pending', 'pre-treatment', 'powder-applied', 'delivered', 'delivery-statement') DEFAULT 'pending'");
    }

    public function down(): void
    {
        // Update any 'delivery-statement' values to 'delivered' before reverting
        DB::table('jobcards')
            ->where('jobcard_status', 'delivery-statement')
            ->update(['jobcard_status' => 'delivered']);
            
        DB::statement("ALTER TABLE `jobcards` MODIFY `jobcard_status` ENUM('pending', 'pre-treatment', 'powder-applied', 'delivered') DEFAULT 'pending'");
    }
};