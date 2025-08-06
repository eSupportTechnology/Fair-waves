<?php

namespace App\Mail;

use App\Models\ReturnRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReturnRequestStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $returnRequest;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct(ReturnRequest $returnRequest, $status)
    {
        $this->returnRequest = $returnRequest;
        $this->status = $status;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = $this->status === 'approved' 
            ? 'Your ' . ucfirst($this->returnRequest->request_type) . ' Request has been Approved'
            : 'Your ' . ucfirst($this->returnRequest->request_type) . ' Request has been Rejected';

        return $this->view('emails.return-request-status')
                    ->subject($subject)
                    ->with([
                        'returnRequest' => $this->returnRequest,
                        'status' => $this->status
                    ]);
    }
}
