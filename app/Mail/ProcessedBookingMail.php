<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

// In your ProcessedBookingMail.php
class ProcessedBookingMail extends Mailable
{
    public $booking;
    public $messageText;
    public $checkout;

    public function __construct($booking, $messageText, $checkout)
    {
        $this->booking = $booking;
        $this->messageText = $messageText;
        $this->checkout = $checkout;
    }

    public function build()
    {
        return $this->view('email.processed-booking')
                    ->with([
                        'booking' => $this->booking,
                        'messageText' => $this->messageText,
                        'checkout' => $this->checkout,
                    ]);
    }
}
