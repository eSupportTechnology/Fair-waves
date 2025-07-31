<?php

namespace App\Mail;

use App\Models\ReturnRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReturnRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $returnRequest;

    public function __construct(ReturnRequest $returnRequest)
    {
        $this->returnRequest = $returnRequest;
    }

    public function build()
    {
        $subject = $this->returnRequest->request_type === 'cancel' 
            ? "New Order Cancellation Request - #{$this->returnRequest->order_code}"
            : "New Product Return Request - #{$this->returnRequest->order_code}";
            
        return $this->subject($subject)
            ->view('emails.return-request')
            ->with('returnRequest', $this->returnRequest);
    }
}
