<?php

namespace App\Mail;

use App\Models\ContractIn;
use App\Models\ContractOut;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckOutMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contract;
    public $contractOutData;

    public function __construct(ContractIn $contract, ContractOut $contractOutData)
    {
        $this->contract = $contract;
        $this->contractOutData = $contractOutData;
    }

    public function build()
    {
        return $this->subject('Your CheckOut Details')
                    ->view('mail.checkout')
                    ->with([
                        'contract' => $this->contract,
                        'ContractOut' => $this->contractOutData,
                    ]);
    }
}

