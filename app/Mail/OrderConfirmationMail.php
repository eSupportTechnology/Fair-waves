<?php

namespace App\Mail;

use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $orderItems;

    public function __construct(CustomerOrder $order)
    {
        $this->order = $order;
        $this->orderItems = CustomerOrderItems::where('order_code', $order->order_code)
            ->with('product.images')
            ->get();
    }

    public function build()
    {
        return $this->subject("Order Confirmation - Order #{$this->order->order_code}")
            ->view('emails.order-confirmation');
    }
}
