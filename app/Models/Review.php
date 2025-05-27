<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'rating',
        'review',
        'is_anonymous',
        'media',
        'status',
        'reviewer_id',
        'order_item_id',
    ];

    protected $casts = [
        'media' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItem()
{
    return $this->belongsTo(CustomerOrderItems::class, 'order_item_id', 'id');
}

}
