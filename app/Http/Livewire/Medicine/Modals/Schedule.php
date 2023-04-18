<?php

namespace App\Http\Livewire\Medicine\Modals;

use App\Models\Medicine\MedicineReserve;
use Livewire\Component;
use LivewireUI\Modal\Modal;
use LivewireUI\Modal\ModalComponent;

class Schedule extends ModalComponent
{
    public $medicineReserves,$name,$type,$class,$typLicense,$sede,$dateReserve,$date,$time,$scheduleId;
    public function mount($scheduleId)
    {
        // $this->medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])
        // ->where('id',$scheduleId)
        // ->get();
        $medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])
        ->where('id',$scheduleId)->get();        
        $this->name = $medicineReserves[0]->medicineReserveMedicine->medicineUser->name.' '.$medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant[0]->apParental.' '.$medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant[0]->apMaternal; 
        $this->type = $medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->name;

        if ($medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->id == 1) {
            $this->class = $medicineReserves[0]->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name;
            $this->typLicense = $medicineReserves[0]->medicineReserveMedicine->medicineInitial[0]->medicineInitialClasificationClass->name;
        } else if($medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->id == 2){
            $this->class = $medicineReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name;
            $this->typLicense = $medicineReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationClasificationClass->name;
        }
        $this->sede = $medicineReserves[0]->user->name;
        $this->dateReserve = $medicineReserves[0]->dateReserve;

        $fechaHora = $this->dateReserve;
        // dump($fechaHora);   

        $separar = (explode(" ",$fechaHora));
        $this->date = $separar[0];
        // dump($this->date);
        $this->time = $separar[1];  
        // $this->to_user_headquarters = $medicineReserves[0]->to_user_headquarters;
        // $this->idReserve = $id;
    }
    public function render()
    {
        return view('livewire.medicine.modals.schedule');
    }
    public function reschedules(){
        //  dd($this->time);
    }

}
