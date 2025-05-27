<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AffiliateReferral extends Model
{
    use HasFactory;

    // Define table name if it does not follow Laravel's naming convention
    protected $table = 'affiliate_referrals';

    // Define fillable properties for mass assignment
    protected $fillable = [
        'user_id',
        'raffle_ticket_id',
        'product_url',
        'views_count',
        'referral_count',
        'product_price',
        'affiliate_commission',
        'total_affiliate_price',
    ];

    /**
     * Relationships
     */

    // AffiliateReferral belongs to an AffiliateUser
    public function affiliateUser()
    {
        return $this->belongsTo(AffiliateUser::class, 'user_id');
    }

    // AffiliateReferral belongs to a RaffleTicket
    public function raffleTicket()
    {
        return $this->belongsTo(RaffleTicket::class, 'raffle_ticket_id');
    }
}
