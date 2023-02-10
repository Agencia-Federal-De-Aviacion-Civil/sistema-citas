<?php

namespace App\Http\Livewire\Appointment\Headquarters;

use App\Models\catalogue\headquarter;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Headquarters extends Component
{
    public $modal = false;
    public $id_save, $name, $email, $password, $direction, $url, $passwordConfirmation;
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|same:passwordConfirmation',
            'direction' => 'required',
            'url' => 'required|url'
        ];
    }
    public function render()
    {
        $headquarters = headquarter::with('headquarterUser')->get();
        return view('livewire.appointment.headquarters.headquarters',compact('headquarters'))
            ->layout('layouts.app');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function openModal()
    {
        $this->modal = true;
    }
    public function closeModal()
    {
        $this->modal = false;
    }
    public function addHeadquarter()
    {
        $this->openModal();
    }
    public function save()
    {
        $this->validate();
        $saveHeadrquearter = User::updateOrCreate(
            ['id' => $this->id_save],
            [
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]
        );
        $saveHeadrquearter = headquarter::updateOrCreate(
            ['id' => $this->id_save],
            [
                'user_id' => $saveHeadrquearter->id,
                'direction' => $this->direction,
                'url' => $this->url
            ]
        );
        $this->reset();
        $this->closeModal();
    }
}
