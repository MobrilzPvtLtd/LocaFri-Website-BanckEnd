<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class AnalyticsReport extends Mailable
{
    use Queueable, SerializesModels;

    public $matrixData;

    /**
     * Create a new message instance.
     *
     * @param  mixed  $matrixData
     * @return void
     */
    public function __construct($matrixData)
    {
        $this->matrixData = $matrixData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
               ->subject('Vehicle Booking Analytics Report')
                ->view('emails.analytics_report', [
                    'matrixData' => $this->matrixData,
                ]);
    }
}
