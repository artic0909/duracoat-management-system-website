<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client_id',
        'order_number',
    ];

    public function client()
    {
        return $this->belongsTo(ClientMaterial::class, 'client_id');
    }

    public function jobcards()
    {
        return $this->hasMany(Jobcard::class, 'order_id');
    }

}
