<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paint extends Model
{
    use HasFactory;

    protected $fillable = [
        'paint_unique_id',
        'brand_name',
        'ral_code',
        'shade_name',
        'finish',
        'quantity',
        'status',
    ];
}
