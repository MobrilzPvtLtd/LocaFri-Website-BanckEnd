<?php

namespace App\Livewire;

use Livewire\Component;

class TermsAndConditions extends Component
{
    public $link;

    public function mount()
    {

        $this->link = url('/terms-and-conditions');
    }

    public function render()
    {
        return view('livewire.terms-and-conditions');
    }
}
