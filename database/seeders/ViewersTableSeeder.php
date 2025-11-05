<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ViewersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('viewers')->insert([
            [
                'name' => 'Duracoat Viewer',
                'email' => 'dura.viewer@mail.com',
                'password' => Hash::make('dura2025'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
