<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VehicleInspectionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;  // Store the data for the email

    /**
     * Create a new message instance.
     *
     * @param array $data - The data to pass to the email template
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Mail.vehicle_inspection') // The Blade view for the email content
                    ->subject($this->data['message_title']) // Set the subject dynamically
                    ->with('data', $this->data);  // Pass the data array to the view
    }
}
