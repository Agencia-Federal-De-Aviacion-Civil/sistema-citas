<?php

namespace App\Http\Livewire\Linguistics;

use App\Models\Linguistic\Linguistic;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeLinguistics extends Component
{
    public $referenceNumber;
    public function rules()
    {
        return [
            'referenceNumber' => 'required',
        ];
    }
    public function render()
    {
        return view('livewire.linguistics.home-linguistics')
            ->layout('layouts.app');
    }
    public function save()
    {
        $this->validate();
        Linguistic::Create([
            'user_id' => Auth::user()->id,
            'referenceNumber' => $this->referenceNumber,
        ]);
    }
}
