<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealerReferral extends Model
{
    use HasFactory;

    protected $fillable = ['dealer_id', 'referred_id', 'approved'];

    public function dealer()
    {
        return $this->belongsTo(User::class, 'dealer_id');
    }

    public function referred()
    {
        return $this->belongsTo(User::class, 'referred_id');
    }
}
