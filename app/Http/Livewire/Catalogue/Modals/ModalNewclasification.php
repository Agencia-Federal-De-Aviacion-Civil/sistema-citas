<?php

namespace App\Http\Livewire\Catalogue\Modals;

use App\Models\Catalogue\ClasificationClass;
use App\Models\Catalogue\TypeClass;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class ModalNewclasification extends ModalComponent
{
    use Actions;
    use WithFileUploads;
    public $modal,$id_save,$name,$type_class_id,$clasification,$classificId,$title,$classe;
       
    public function rules()
    {
        $rules =  [
            'name' => 'required',
            'type_class_id' => 'required',
        ];
        return $rules;
    }
    public function mount($classificId)
    {
        $this->classificId = $classificId;
        $this->valores($classificId);
        $this->clasification = ClasificationClass::all();
        $this->classe = TypeClass::all();
    }
    public function render()
    {
        return view('livewire.catalogue.modals.modal-newclasification');
    }
   
    public static function modalMaxWidth(): string
    {
        return '3xl';
    }
    public function clean()
    {
        $this->reset(['name','type_class_id']);
    }
    public function valores($classificId)
    {
        $this->classificId = $classificId;
        if ($this->classificId != 0) {
            $this->title = 'EDITA USUARIO';
            $clasification = ClasificationClass::where('id', $this->classificId)->get();
            $this->id_save = $clasification[0]->id;
            $this->name = $clasification[0]->name;
            $this->type_class_id=$clasification[0]->type_class_id;
        } else {
            $this->title = 'AGREGAR USUARIO';
            $this->name =  '';
            $this->type_class_id =  '';
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
        $clasificationData = [
            'name' => strtoupper($this->name),
            'type_class_id' => $this->type_class_id,
        ];
        $clasifications = ClasificationClass::updateOrCreate(
            ['id' => $this->id_save],
            $clasificationData,
        );

        $this->notification([
            'title'       => 'CLASIFICACIÓN AGREGADA CON EXITO',
            'icon'        => 'success',
            'timeout' => '3100'
        ]);
        $this->emit('clasifications');
        $this->closeModal();
    }
    public function messages()
    {
        return [
            'name.required' => 'Campo obligatorio',
            'type_class_id' => 'Campo obligatorio',
        ];
    }
}
