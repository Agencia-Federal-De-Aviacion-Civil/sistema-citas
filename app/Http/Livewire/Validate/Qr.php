<?php

namespace App\Http\Livewire\Validate;

use App\Models\Medicine\MedicineReserve;
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
        return view('livewire.validate.qr')
            ->layout('layouts.app');
    }
    public function read()
    {
        $this->validate();
        try {
            $decrypted = Crypt::decryptString($this->textRead);
            $separated = explode('*', $decrypted);
            $medicine_id = $separated[0];
            dd($date_reserve = $separated[1]);
            $curp = $separated[2];
            $medicineReserves = MedicineReserve::with(['medicineReserveMedicine.medicineUser.userParticipant', 'medicineReserveFromUser', 'user'])
                ->whereHas('medicineReserveMedicine.medicineUser.userParticipant', function ($q) use ($curp) {
                    $q->where('curp', $curp);
                })->where('medicine_id', $medicine_id)
                ->where('dateReserve', $date_reserve)->get();
            $this->dialog([
                'title'       => '¡CITA MÉDICA VERIFICADA!',
                'description' => 'NOMBRE: ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->name . ' ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant->pluck('apParental')->first() . ' ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant->pluck('apMaternal')->first() . 
                '<br> CURP: ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->userParticipant->pluck('curp')->first() . '<br> TIPO: ' .$medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->name 
                . '<br> TIPO DE CLASE: ' . $medicineReserves[0]->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name
                    . '<br> UNIDAD MEDICA: ' . $medicineReserves[0]->user->name . '<br> FECHA: ' . $medicineReserves[0]->dateReserve . '<br> HORA: '.$medicineReserves[0]->medicineSchedule->time_start,
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