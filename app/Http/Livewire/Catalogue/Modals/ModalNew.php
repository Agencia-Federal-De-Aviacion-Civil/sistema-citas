<?php

namespace App\Http\Livewire\Catalogue\Modals;

use App\Models\System;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class ModalNew extends ModalComponent
{
    use Actions;
    use WithFileUploads;
    public $roles, $modal, $id_save, $id_update, $name, $catalogsId, $title;
       
    public function rules()
    {
        $rules =  [
            'name' => 'required',
        ];
        return $rules;
    }
    public function mount($catalogsId)
    {
        $this->catalogsId = $catalogsId;
        $this->valores($catalogsId);
    }
    public function render()
    {
        return view('livewire.catalogue.modals.modal-new');
    }
   
    public static function modalMaxWidth(): string
    {
        return '3xl';
    }
    public function clean()
    {
        $this->reset(['name']);
    }
    public function valores($catalogsId)
    {
        $this->catalogsId = $catalogsId;
        if ($this->catalogsId != 0) {
            $system = System::where('id', $this->catalogsId)->get();
            $this->name = $system[0]->name;
        } else {
            $this->title = 'AGREGAR USUARIO';
            $this->name =  '';
        }
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function save()
    {
        // dd($this->id_save);
        $this->validate();
        $systemData = [
            'name' => $this->name,
        ];
        $systems = system::updateOrCreate(
            ['id' => $this->id_save],
            $systemData,
        );

        $this->notification([
            'title'       => 'SISTEMA AGREGADO CON EXITO',
            'icon'        => 'success',
            'timeout' => '3100'
        ]);
        $this->emit('systems');
        $this->closeModal();
    }
    public function messages()
    {
        return [
            'name.required' => 'Campo obligatorio',
        ];
    }
}
