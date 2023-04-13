<?php

namespace App\Http\Livewire\Validate;

use App\Models\LicensePdf;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use WireUi\Traits\Actions;

class Qr extends Component
{
    use Actions;
    public $textRead, $licenses;
    protected $rules = [
        'textRead' => 'required'
    ];
    /*public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }*/
    public function render()
    {
        return view('livewire.validate.qr')
            ->layout('layouts.app');
    }
    /*public function read()
    {
        $this->validate();
        $decrypted = Crypt::decryptString($this->textRead);
        $queryLicenses = LicensePdf::where('curp', $decrypted)->get();
        $this->dialog([
            'title'       => '¡CITAS MÉDICA VERIFICADA!',
            'description' => 'NOMBRE: ' . $queryLicenses[0]->name . '<br> CURP: ' . strtoupper($queryLicenses[0]->curp) . '<br> NACIONALIDAD: ' . $queryLicenses[0]->nacionality . '<br> EDAD: ' . $queryLicenses[0]->age
                . '<br> FECHA DE EVALUACIÓN: ' . $queryLicenses[0]->evaluationDay . '<br> LUGAR DEL EXAMEN: ' . $queryLicenses[0]->testPlace . '<br> VIGENCIA: ' . $queryLicenses[0]->validity
                . '<br> MEDICO EXAMINADOR: ' . $queryLicenses[0]->medical . '<br> CLASE: ' . $queryLicenses[0]->class . '<br> RESULTADO: ' . $queryLicenses[0]->result,
            'icon'        => 'success'
        ]);
        $this->reset(['textRead']);
    }*/
    public function messages()
    {
        return [
            'textRead.required' => 'Verificacion necesaria.',
            'textRead.min' => 'Verificación invalida.',
        ];
    }
}
