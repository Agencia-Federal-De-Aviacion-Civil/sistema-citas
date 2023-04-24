<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use LivewireUI\Modal\Contracts\ModalComponent;
use LivewireUI\Modal\ModalComponent;
class Index extends ModalComponent
{

        // $this->roles = User::with(['roles'])->get();
    public function render()
    {
        return view('livewire.users.index');
    }

}
