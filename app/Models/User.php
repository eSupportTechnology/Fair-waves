<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'dob',
        'phone',
        'gender',
        'profile_image',
        'role',
        'referred_by',
        'fname',
        'lname',
        'customer_status',
        'dealer_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the profile image URL.
     */
    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/' . $this->profile_image);
        }
        return asset('backend/assets/images/default-user.png');
    }


    public function customerOrders()
    {
        return $this->hasMany(CustomerOrder::class, 'user_id', 'id');
    }

    public function dealerProfile()
    {
        return $this->hasOne(DealerProfile::class);
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function orders()
    {
        return $this->hasMany(CustomerOrder::class);
    }

    public function dealerReferrals()
    {
        return $this->hasMany(DealerReferral::class, 'dealer_id');
    }

    public function referredByDealer()
    {
        return $this->hasOne(DealerReferral::class, 'referred_id');
    }

    // For direct referred users
    public function directReferrals()
    {
        return $this->hasManyThrough(
            User::class,
            DealerReferral::class,
            'dealer_id',     // Foreign key on dealer_referrals
            'id',            // Local key on users
            'id',            // Local key on this model
            'referred_id'    // Foreign key on users
        );
    }

    public function bankDetail()
    {
        return $this->hasOne(BankDetail::class);
    }

    public function kycDetail()
    {
        return $this->hasOne(KYCDetail::class);
    }
}
