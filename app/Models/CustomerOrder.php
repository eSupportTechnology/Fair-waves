<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory;

    protected $table = 'customer_orders';

    protected $fillable = [
        'order_code',
        'user_id',
        'customer_name',
        'phone',
        'email',
        'house_no',
        'apartment',
        'city',
        'postal_code',
        'date',
        'total_cost',
        'status',
        'payment_method',
        'payment_status',
        'activity_logs', // Include activity_logs in fillable
    ];

    // Cast activity_logs as an array to handle JSON data
    protected $casts = [
        'activity_logs' => 'array',
    ];

    // Relationship: One order has many items
    public function items()
    {
        return $this->hasMany(CustomerOrderItems::class, 'order_code', 'order_code');
    }

    // Helper method to add an activity log
    public function addActivityLog($message)
    {
        $logs = $this->activity_logs ?? [];
        $logs[] = [
            'timestamp' => now()->format('Y-m-d H:i:s'),
            'message' => $message,
        ];
        $this->update(['activity_logs' => $logs]);
    }
}
