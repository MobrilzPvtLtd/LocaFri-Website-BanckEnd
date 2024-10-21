<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\ContractIn;
use Illuminate\Queue\SerializesModels;

class ContractCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contract;

    /**
     * Create a new message instance.
     *
     * @param  ContractIn  $contract
     * @return void
     */
    public function __construct(ContractIn $contract)
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
                    ->with(['ContractIn' => $this->contract])
                    ->subject('Check-In Successful');
    }
}
