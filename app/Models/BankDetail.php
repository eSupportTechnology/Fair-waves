<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    protected $fillable = [
        'user_id',
        'bank_name',
        'bank_branch',
        'account_name',
        'account_number',
        'account_type',
        'bank_front_image',
        'bank_back_image',
        'bank_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
