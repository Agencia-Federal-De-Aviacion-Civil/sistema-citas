<?php

namespace App\Http\Livewire\Document;

use Livewire\Component;

class PaymentFormat extends Component
{
    public $paymentformat;
    public function mount($paymentformat)
    {
        $this->paymentformat = $paymentformat;
    }
    public function render()
    {
        return view('livewire.document.payment-format');
    }
}
