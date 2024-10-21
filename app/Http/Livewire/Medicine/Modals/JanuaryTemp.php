<?php

namespace App\Http\Livewire\Medicine\Modals;

use App\Models\Document;
use App\Models\Medicine\Medicine;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class JanuaryTemp extends ModalComponent
{
    use WithFileUploads;
    public $scheduleId, $medicineId, $reference_number, $pay_date, $document_pay;
    public function mount($scheduleId, $medicineId)
    {
        $this->scheduleId = $scheduleId;
        $this->medicineId = $medicineId;
    }
    public function rules()
    {
        return [
            'reference_number' => 'required|unique:medicines',
            'pay_date' => 'required',
            'document_pay' => 'required|mimetypes:application/pdf|max:5000',
        ];
    }
    public function render()
    {
        return view('livewire.medicine.modals.january-temp');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function save()
    {
        $this->validate();
        $completedJanuaryReserve = Medicine::find($this->medicineId);
        $completedJanuaryReserve->update([
            'reference_number' => $this->reference_number,
            'pay_date' => $this->pay_date,
        ]);
        $updateJanuaryDocument = Document::find($completedJanuaryReserve->document_id);
        $extension = $this->document_pay->getClientOriginalExtension();
        $fileName = $this->reference_number . '-' . $this->pay_date . '.' . $extension;
        $updateJanuaryDocument->update([
            'name_document' => $this->document_pay->storeAs('documentos/medicina', $fileName, 'public'),
        ]);
        $this->reset();
        $this->emit('updatePayJanuary');
        $this->closeModal();
    }





    public function messages()
    {
        return [
            'reference_number.required' => 'El campo número de referencia es requerido',
            'reference_number.unique' => 'Llave de pago ya registrada',
            'pay_date.required' => 'El campo fecha de pago es requerido',
            'document_pay.required' => 'El campo documento de pago es requerido',
            'document_pay.mimetypes' => 'El campo documento de pago debe ser un archivo PDF',
            'document_pay.max' => 'El campo documento de pago no debe ser mayor a 5MB',
        ];
    }
}
