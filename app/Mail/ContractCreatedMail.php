<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContractCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contract; 

    /**
     * Create a new message instance.
     *
     * @param  mixed  $contract
     * @return void
     */
    public function __construct($contract)
    {
        $this->contract = $contract; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.contract_created') 
                    ->with(['contract' => $this->contract]) 
                    ->subject('New Contract Created'); 
    }
}
