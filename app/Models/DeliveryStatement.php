<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryStatement extends Model
{
    protected $fillable = [
        'order_id',
        'jobcard_id',
        'date',
        'qty',
        'invoice_no',
        'billing_amount',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function jobcard()
    {
        return $this->belongsTo(Jobcard::class);
    }
}
