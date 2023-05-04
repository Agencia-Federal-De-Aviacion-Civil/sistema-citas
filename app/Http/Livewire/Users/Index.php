<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Date\Date;
// use LivewireUI\Modal\Contracts\ModalComponent;
use LivewireUI\Modal\ModalComponent;
class Index extends ModalComponent
{
    public $dateNow;
    public function render()
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');

        return view('livewire.users.index');
    }
}
