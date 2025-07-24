<?php

namespace App\Mail;

use App\Models\CustomerOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $newStatus;

    public function __construct(CustomerOrder $order, $newStatus)
    {
        $this->order = $order;
        $this->newStatus = $newStatus;
    }

    public function build()
    {
        return $this->subject("Your Order #{$this->order->order_code} is now {$this->newStatus}")
            ->view('emails.order-status-updated');
    }
}
