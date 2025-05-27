<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'status',
        'profile_image',
        'bank_name',
        'branch',
        'account_name',
        'account_number'
    ];


    public function shop()
    {
        return $this->hasOne(Shop::class, 'vendor_id');
    }



    public function wallet()
    {
        return $this->hasOne(VendorWallet::class, 'vendor_id');
    }


    
}
