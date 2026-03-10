<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NineTankTest extends Model
{
    protected $fillable = [
        // Meta
        'testing_date',
        'jobcard_no',

        // Tank 1 — Apdeg-60
        't1_chemical_name',
        't1_testing_value',
        't1_result',
        't1_need_chemical',

        // Tank 2 — Water
        't2_chemical_name',
        't2_testing_value',
        't2_result',
        't2_need_attention',

        // Tank 3 — Aprust-21
        't3_chemical_name',
        't3_testing_value',
        't3_result',
        't3_need_chemical',

        // Tank 4 — Water
        't4_chemical_name',
        't4_testing_value',
        't4_result',
        't4_need_attention',

        // Tank 5 — S-101
        't5_chemical_name',
        't5_testing_value',
        't5_result',
        't5_need_attention',

        // Tank 6 — Act-505
        't6_chemical_name',
        't6_testing_value',
        't6_result',
        't6_need_attention',

        // Tank 7 — Aphox-ZC
        't7_chemical_name',
        't7_testing_value',
        't7_need_level',
        't7_result',
        't7_need_chemical',

        // Tank 8 — Water
        't8_chemical_name',
        't8_testing_value',
        't8_result',
        't8_need_attention',

        // Tank 9 — Passeal-1
        't9_chemical_name',
        't9_testing_value',
        't9_result',
        't9_need_attention',
    ];

    protected $casts = [
        'testing_date' => 'date',
    ];
}
