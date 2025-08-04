<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class EmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userData;
    public $verificationUrl;
    public $subject = 'Verify Your Email Address - Fair Waves';

    /**
     * Create a new message instance.
     */
    public function __construct($userData)
    {
        $this->userData = $userData;
        
        // Generate verification URL with signed route for security
        $this->verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60), // Link expires in 60 minutes
            [
                'id' => $userData['id'],
                'email' => $userData['email'],
                'hash' => sha1($userData['email'])
            ]
        );
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('emails.email-verification')
                    ->subject($this->subject)
                    ->with([
                        'userData' => $this->userData,
                        'verificationUrl' => $this->verificationUrl
                    ]);
    }
}
