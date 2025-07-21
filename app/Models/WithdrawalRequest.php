<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    use HasFactory;

    protected $fillable = ['dealer_id', 'amount', 'status', 'bv', 'bank_name', 'bank_branch', 'account_name', 'account_number'];

    public function dealer()
    {
        return $this->belongsTo(User::class, 'dealer_id');
    }

    public function bankDetail()
    {
        return $this->belongsTo(BankDetail::class, 'dealer_id', 'user_id');
    }
}
