<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealerProductOrder extends Model
{
    protected $fillable = ['dealer_product_link_id','customer_order_item_id', 'user_id'];

    public function link()
    {
        return $this->belongsTo(DealerProductLink::class, 'dealer_product_link_id');
    }
    public function order()
    {
        return $this->belongsTo(CustomerOrderItems::class, 'customer_order_item_id');
    }

    public function dealer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
