<?php

namespace App\Http\Livewire\Validate;

use App\Models\Catalogue\state;
use App\Models\LicensePdf;
use App\Models\Medicine\MedicineReserve;
use App\Models\UserParticipant;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use WireUi\Traits\Actions;

class Qr extends Component
{
    use Actions;
    public $textRead, $licenses, $medicineReserves;
    protected $rules = [
        'textRead' => 'required'
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        $prueba = state::all();
        return view('livewire.validate.qr', compact('prueba'))
            ->layout('layouts.app');
    }
    public function read()
    {
        $this->validate();
        try {
            $decrypted = Crypt::decryptString($this->textRead);
            $this->medicineReserves = MedicineReserve::with(['medicineReserveMedicine.medicineUser.userParticipant', 'medicineReserveFromUser', 'user'])
                ->whereHas('medicineReserveMedicine.medicineUser.userParticipant', function ($q) use ($decrypted) {
                    $q->where('curp', $decrypted);
                })->first();
            // dd($this->medicineReserves);  
            $this->dialog([
                'title'       => '¡CITA MÉDICA VERIFICADA!',
                // 'description' => 'NOMBRE: ' . $medicineReserves . '',
                'icon'        => 'success'
            ]);
        } catch (DecryptException $e) {
            $this->dialog([
                'title'       => 'Error',
                'description' => 'Se han detectado anomalías en el cifrado, la información del codigo QR no coincide con nuestros registros',
                'icon'        => 'error'
            ]);
        }
        $this->reset(['textRead']);
    }

    public function messages()
    {
        return [
            'textRead.required' => 'Verificacion necesaria.',
            'textRead.min' => 'Verificación invalida.',
        ];
    }
}

// eyJpdiI6IlRHSGdjakRKZUpjSXpEMlFoWkRWd1E9PSIsInZhbHVlIjoiSjk0M1kxSVMyWWFPc0FVblIwUC9PQT09IiwibWFjIjoiMmMyNTc0ZGUxODMyNzQwZWQwYzE1ZmFlMmZmODBiMzMwZDM0MTU0Y2FmNTZhNzdjMDVlYjYwZTlkNDUyZjYzNCIsInRhZyI6IiJ9