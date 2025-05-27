<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AffiliateUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RaffleTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token',
        'status',
    ];

    // Relationship with the AffiliateUser model
    public function user()
    {
        return $this->belongsTo(AffiliateUser::class);
    }

    public function affiliateLinks()
    {
        return $this->hasMany(AffiliateLink::class);
    }

    public function affiliateReferrals()
    {
        return $this->hasMany(AffiliateReferral::class, 'raffle_ticket_id');
    }


}
