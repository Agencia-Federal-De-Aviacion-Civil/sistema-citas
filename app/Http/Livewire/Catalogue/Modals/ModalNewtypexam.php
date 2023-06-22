<?php

namespace App\Http\Livewire\Catalogue\Modals;

use App\Models\Catalogue\TypeExam;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class ModalNewtypexam extends ModalComponent
{
    use Actions;
    use WithFileUploads;
    public $modal, $id_save, $id_update, $name, $typexamsId, $title,$exams,$exam;
       
    public function rules()
    {
        $rules =  [
            'name' => 'required',
        ];
        return $rules;
    }
    public function mount($typexamsId)
    {
        $this->typexamsId = $typexamsId;
        $this->valores($typexamsId);
        $this->exam = TypeExam::all();
    }
    public function render()
    {
        return view('livewire.catalogue.modals.modal-newtypexam');
    }
   
    public static function modalMaxWidth(): string
    {
        return '3xl';
    }
    public function clean()
    {
        $this->reset(['name']);
    }
    public function valores($typexamsId)
    {
        $this->typexamsId = $typexamsId;
        if ($this->typexamsId != 0) {
            $this->title = 'EDITA EXAMEN';
            $typexam = TypeExam::where('id', $this->typexamsId)->get();
            $this->id_save = $typexam[0]->id;
            $this->name = $typexam[0]->name;
        } else {
            $this->title = 'AGREGAR EXAMEN';
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
        $examData = [
            'name' => $this->name,
        ];
        $exams = TypeExam::updateOrCreate(
            ['id' => $this->id_save],
            $examData,
        );

        $this->notification([
            'title'       => 'EXAMEN AGREGADO CON EXITO',
            'icon'        => 'success',
            'timeout' => '3100'
        ]);
        $this->emit('exams');
        $this->closeModal();
    }
    public function messages()
    {
        return [
            'name.required' => 'Campo obligatorio',
        ];
    }
}
