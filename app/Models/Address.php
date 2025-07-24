<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_order_id',
        'fname',
        'lname',
        'phone_num',
        'email',
        'address',
        'apartment',
        'city',
        'postal_code',
        'default'
    ];




    // Define the relationship with the User model

}


