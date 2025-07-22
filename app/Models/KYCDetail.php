<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KYCDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kyc_doc_type',
        'kyc_doc_number',
        'kyc_doc_front',
        'kyc_doc_back',
        'selfie',
        'kyc_status',
        'kyc_reject_reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
