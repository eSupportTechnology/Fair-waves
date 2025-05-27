<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AffiliateProduct extends Model
{
    use HasFactory;

    // Specify the table name if it does not follow Laravel's naming conventions
    protected $table = 'affiliate_product';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'product_id',
        'affiliate_link_id',
    ];

    /**
     * Relationships
     */

    // Relationship with Product model
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Relationship with AffiliateLink model
    public function affiliateLink()
    {
        return $this->belongsTo(AffiliateLink::class, 'affiliate_link_id');
    }
}
