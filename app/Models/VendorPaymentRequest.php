<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VendorPaymentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'request_amount',
        'processing_fee',
        'paid_amount',
        'bank_name',
        'branch',
        'account_name',
        'account_number',
        'status',
        'requested_at',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}
