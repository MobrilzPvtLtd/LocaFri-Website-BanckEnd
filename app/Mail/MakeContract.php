<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MakeContract extends Mailable
{
    use Queueable, SerializesModels;

    public $checkout;

    /**
     * Create a new message instance.
     */
    public function __construct($checkout)
    {
        $this->checkout = $checkout; // Store the checkout data
    }

    public function build()
    {
        return $this->subject('Contract Created for Your Booking! 🎉')
                    ->view('email.MakeContract')
                    ->with(['data' => $this->checkout]);
    }
}


