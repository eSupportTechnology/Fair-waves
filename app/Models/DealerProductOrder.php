<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealerProductOrder extends Model
{
    protected $fillable = ['dealer_product_link_id', 'customer_name', 'quantity', 'total_price', 'status'];

    public function link()
    {
        return $this->belongsTo(DealerProductLink::class, 'dealer_product_link_id');
    }
}
