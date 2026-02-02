<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client_id',
        'order_number',
        'amount',
        'billing_amount',
    ];

    public function client()
    {
        return $this->belongsTo(ClientMaterial::class, 'client_id');
    }

    public function jobcards()
    {
        return $this->hasMany(Jobcard::class, 'order_id');
    }

    public function deliveryStatements()
    {
        return $this->hasMany(DeliveryStatement::class, 'order_id');
    }
}
