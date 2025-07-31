<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'customer_name',
        'phone',
        'email',
        'order_date',
        'request_type',
        'cancel_reason',
        'status',
        'admin_response',
        'processed_by',
        'processed_at'
    ];

    protected $dates = [
        'order_date',
        'processed_at'
    ];

    // Relationship with CustomerOrder
    public function customerOrder()
    {
        return $this->belongsTo(\App\Models\CustomerOrder::class, 'order_code', 'order_code');
    }

    // Relationship with SystemUser (who processed the request)
    public function processedByUser()
    {
        return $this->belongsTo(\App\Models\SystemUser::class, 'processed_by', 'email');
    }
}