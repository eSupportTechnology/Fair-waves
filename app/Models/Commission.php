<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = ['dealer_id', 'from_user_id', 'amount', 'bv', 'level', 'customer_order_id'];

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
