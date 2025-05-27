<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class AffiliateUser extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'affiliate_users';

    // Fillable fields
    protected $fillable = [
        'name',
        'address',
        'district',
        'DOB',
        'gender',
        'NIC',
        'contactno',
        'email',
        'password',
        'promotion_method',
        'instagram_url',
        'facebook_url',
        'tiktok_url',
        'youtube_url',
        'content_website_url',
        'content_whatsapp_url',
        'bank_name',
        'branch',
        'account_name',
        'account_number',
        'status',
    ];

    // Cast 'promotion_method' to array
    protected $casts = [
        'promotion_method' => 'array',
        'DOB' => 'date',
    ];

    // Automatically hash the password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function affiliateLinks()
    {
        return $this->hasMany(AffiliateLink::class, 'user_id');
    }
    
    public function affiliateReferrals()
    {
        return $this->hasMany(AffiliateReferral::class, 'user_id');
    }


}
