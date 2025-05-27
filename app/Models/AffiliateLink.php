<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AffiliateLink extends Model
{
    use HasFactory;

    protected $table = 'affiliate_links';

    protected $fillable = [
        'user_id',
        'raffle_ticket_id',
        'link',
    ];

    // Relationships

    // AffiliateLink belongs to an AffiliateUser
    public function affiliateUser()
    {
        return $this->belongsTo(AffiliateUser::class, 'user_id');
    }

    // AffiliateLink belongs to a RaffleTicket
    public function raffleTicket()
    {
        return $this->belongsTo(RaffleTicket::class);
    }

    public function affiliateProducts()
    {
        return $this->hasMany(AffiliateProduct::class, 'affiliate_link_id');
    }

    

    public function product()
    {
        return $this->hasOneThrough(Product::class, AffiliateProduct::class, 'affiliate_link_id', 'id', 'id', 'product_id');
    }

}
