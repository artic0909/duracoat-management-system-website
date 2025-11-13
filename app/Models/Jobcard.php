<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobcard extends Model
{
    protected $fillable = [
        'order_id',
        'client_id',
        'jobcard_creation_date',
        'jobcard_number',
        'material_type',
        'material_name',
        'material_quantity',
        'material_unit',
        'paint_id',
        'ral_code',
        'paint_used',
        'jobcard_status',
        'pre_treatment_date',
        'powder_apply_date',
        'delivery_date',
        'delivery_statement',
    ];

    protected $casts = [
        'jobcard_creation_date' => 'date',
        'pre_treatment_date'    => 'date',
        'powder_apply_date'     => 'date',
        'delivery_date'         => 'date',
        'delivery_statement'    => 'string',
    ];

    /**
     * Relation with Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Relation with ClientMaterial
     */
    public function client()
    {
        return $this->belongsTo(ClientMaterial::class, 'client_id');
    }

    /**
     * Relation with Paint
     */
    public function paint()
    {
        return $this->belongsTo(Paint::class, 'paint_id');
    }

    public function tests()
    {
        return $this->hasMany(JobcardTest::class, 'jobcard_id');
    }
}
