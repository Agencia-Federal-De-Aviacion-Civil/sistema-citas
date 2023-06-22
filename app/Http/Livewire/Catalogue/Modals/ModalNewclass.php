<?php

namespace App\Http\Livewire\Catalogue\Modals;

use App\Models\Catalogue\TypeClass;
use App\Models\Catalogue\TypeExam;
use App\Models\Medicine\MedicineQuestion;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class ModalNewclass extends ModalComponent
{
    use Actions;
    use WithFileUploads;
    public $modal,$id_save,$id_update,$name,$type_exam_id,$examstype,$medicineqs,$medicine_question_id,$classId,$title,$classes,$classe;
       
    public function rules()
    {
        $rules =  [
            'name' => 'required',
            'type_exam_id' => 'required',
            'medicine_question_id' => 'required',
        ];
        return $rules;
    }
    public function mount($classId)
    {
        $this->classId = $classId;
        $this->valores($classId);
        $this->classe = TypeClass::all();
        $this->examstype = TypeExam::all();
        $this->medicineqs = MedicineQuestion::all();
    }
    public function render()
    {
        return view('livewire.catalogue.modals.modal-newclass');
    }
   
    public static function modalMaxWidth(): string
    {
        return '3xl';
    }
    public function clean()
    {
        $this->reset(['name','type_exam_id']);
    }
    public function valores($classId)
    {
        $this->classId = $classId;
        if ($this->classId != 0) {
            $this->title = 'EDITA USUARIO';
            $classe = TypeClass::where('id', $this->classId)->get();
            $this->id_save = $classe[0]->id;
            $this->name = $classe[0]->name;
            $this->type_exam_id=$classe[0]->type_exam_id;
            $this->medicine_question_id=$classe[0]->medicine_question_id;
        } else {
            $this->title = 'AGREGAR USUARIO';
            $this->name =  '';
            $this->type_exam_id =  '';
            $this->medicine_question_id =  '';
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
        $classeData = [
            'name' => strtoupper($this->name),
            'type_exam_id' => $this->type_exam_id,
            'medicine_question_id' => $this->medicine_question_id,
        ];
        $classes = TypeClass::updateOrCreate(
            ['id' => $this->id_save],
            $classeData,
        );

        $this->notification([
            'title'       => 'CLASE AGREGADA CON EXITO',
            'icon'        => 'success',
            'timeout' => '3100'
        ]);
        $this->emit('classes');
        $this->closeModal();
    }
    public function messages()
    {
        return [
            'name.required' => 'Campo obligatorio',
            'type_exam_id' => 'Campo obligatorio',
            'medicine_question_id' => 'Campo obligatorio',
        ];
    }
}
