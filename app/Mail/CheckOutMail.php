<?php

namespace App\Mail;

use App\Models\Contract;
use App\Models\ContractsOut;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckOutMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contract;
    public $contractsOut;

    public function __construct(Contract $contract, ContractsOut $contractsOut)
    {
        $this->contract = $contract;
        $this->contractsOut = $contractsOut;
    }

    public function build()
    {
        return $this->subject('Your CheckOut Details')
                    ->view('mail.checkout')
                    ->with([
                        'contract' => $this->contract,
                        'contractsOut' => $this->contractsOut,
                    ]);
    }
}

