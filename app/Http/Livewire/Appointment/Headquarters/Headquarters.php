<?php

namespace App\Http\Livewire\Appointment\Headquarters;

use App\Models\Catalogue\Headquarter;
use App\Models\System;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Headquarters extends Component
{
    use Actions;
    use WithFileUploads;
    public $modal = false, $modalEdit = false;
    public $id_save, $system_id, $name, $email, $password, $direction, $url, $passwordConfirmation, $sedes, $id_edit;
    public function mount()
    {
    }
    public function rules()
    {
        return [
            'system_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|same:passwordConfirmation',
            'direction' => 'required',
            'url' => 'required|url'
        ];
    }
    public function render()
    {
        $qSystems = System::all();
        $headquarters = Headquarter::with('headquarterUser')->get();
        return view('livewire.appointment.headquarters.headquarters', compact('headquarters', 'qSystems'))
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
    public function editModal($id)
    {
        $this->modalEdit = true;
        $this->sedes = Headquarter::with('headquarterUser')->where('id', $id)->get();
        $this->name = $this->sedes[0]->headquarterUser->name;
        $this->direction = $this->sedes[0]->direction;
        $this->passwordConfirmation = '********';
        $this->password = '********';
        $this->email = $this->sedes[0]->headquarterUser->email;
        $this->url = $this->sedes[0]->url;
        $this->id_edit = $id;
    }
    public function salir()
    {
        $this->modal = false;
        $this->modalEdit = false;
    }
    public function clean()
    {
        $this->reset(['name', 'email', 'password', 'system_id', 'direction', 'url']);
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
        )->assignRole('headquarters');
        $saveHeadrquearter = Headquarter::updateOrCreate(
            ['id' => $this->id_save],
            [
                'user_id' => $saveHeadrquearter->id,
                'system_id' => $this->system_id,
                'direction' => $this->direction,
                'url' => $this->url
            ]
        );
        $this->reset([]);
        $this->closeModal();
        $this->notification([
            'title'       => 'Sede agrada con éxito',
            'icon'        => 'success'
        ]);
    }
    public function edit()
    {
        $headquarter =  Headquarter::find($this->id_edit);
        $headquarter->update(
            [
                'direction' => $this->direction,
                'url' => $this->url
            ]
        );
        $user = User::find($headquarter->user_id);
        $user->update(
            [
                'email' => $this->email
            ]
        );
        $this->modalEdit = false;
        $this->notification([
            'title'       => 'Sede actualizada correctamente',
            'icon'        => 'success'
        ]);
    }
}