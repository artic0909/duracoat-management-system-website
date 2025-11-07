<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobcardTest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'jobcard_id',
        'order_id',
        'client_id',
        'test_date',
        'testing',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'test_date' => 'date',
        'testing' => 'array', // automatically decode/encode JSON data
    ];

    /**
     * Relationships
     */

    // Each test belongs to a Jobcard
    public function jobcard()
    {
        return $this->belongsTo(Jobcard::class);
    }

    // Each test belongs to an Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Each test belongs to a Client (from client_materials table)
    public function client()
    {
        return $this->belongsTo(ClientMaterial::class, 'client_id');
    }
}
