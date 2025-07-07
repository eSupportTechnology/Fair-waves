<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    use HasFactory;

    protected $fillable = ['dealer_id', 'amount', 'status'];

    public function dealer()
    {
        return $this->belongsTo(User::class, 'dealer_id');
    }
}
