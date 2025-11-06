<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientMaterial extends Model
{
    use HasFactory;

    protected $table = 'client_materials';

    protected $fillable = [
        'client_unique_id',
        'client_name',
        'mobile',
        'email',
        'material_details',
    ];

    protected $casts = [
        'material_details' => 'array',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function jobcards()
    {
        return $this->hasMany(Jobcard::class);
    }
}
