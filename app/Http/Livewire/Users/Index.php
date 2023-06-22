<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use LivewireUI\Modal\Contracts\ModalComponent;
use LivewireUI\Modal\ModalComponent;
use Jenssegers\Date\Date;
class Index extends ModalComponent
{
    public $dateNow;
        // $this->roles = User::with(['roles'])->get();
    public function mount()
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');
    }

    public function render()
    {
        return view('livewire.users.index');
    }    
}
