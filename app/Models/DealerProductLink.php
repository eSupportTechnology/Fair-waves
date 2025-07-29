<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealerProductLink extends Model
{
    protected $fillable = ['dealer_id', 'product_id', 'unique_code'];

    public function dealer()
    {
        return $this->belongsTo(User::class, 'dealer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(DealerProductOrder::class);
    }
    public function dealerProfile(){
        return $this->belongsTo(DealerProfile::class, 'dealer_id');
    }
}
