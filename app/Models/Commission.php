<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = ['dealer_id', 'from_user_id', 'order_id', 'amount', 'bv', 'level'];

    public function dealer()
    {
        return $this->belongsTo(User::class, 'dealer_id');
    }

    public function source()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function order()
    {
        return $this->belongsTo(CustomerOrder::class);
    }
}
