<?php

namespace App\Http\Livewire\Appointment;

use App\Models\appointment\user_appointment_success;
use App\Models\appointment\userAppointment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AppointmentHistory extends Component
{
    public $n = 1;
    public $modal = false;
    public $name,$type,$class,$typLicense,$sede,$date,$time,$idAppointmet;
    public function render()
    {
        $appointments = userAppointment::with([
            'appointmentUser', 'appointmentStudying', 'appointmentRenovation', 'appointmentSuccess',
            'appointmentTypeExam', 'appointmentDocument'
        ])
            ->where('user_id', '<>', Auth::user()->id)->get();

        return view('livewire.appointment.appointment-history', compact('appointments'))
            ->layout('layouts.app');
    }



    public function reagendarcita($id){
               
        $appointment = userAppointment::with([
            'appointmentUser', 'appointmentStudying', 'appointmentRenovation', 'appointmentSuccess',
            'appointmentTypeExam', 'appointmentDocument'
        ])
            ->where('user_appointment_success_id', $id)->get();
        $this->name = $appointment[0]->appointmentUser->name . ' ' . $appointment[0]->appointmentUser->apParental . ' ' . $appointment[0]->appointmentUser->apMaternal;
        $this->type = $appointment[0]->appointmentTypeExam->name;
        if($appointment[0]->appointmentTypeExam->id==1){
        $this->class = $appointment[0]->appointmentStudying[0]->studyingClass->name;
        $this->typLicense = $appointment[0]->appointmentStudying[0]->studyingClasification->name;
        }else{
        $this->class = $appointment[0]->appointmentRenovation[0]->renovationClass->name;
        $this->typLicense = $appointment[0]->appointmentRenovation[0]->renovationClasification->name;    
        }
        $this->sede = $appointment[0]->appointmentSuccess->successHeadquarter->headquarterUser->name;
        $this->date = $appointment[0]->appointmentSuccess->appointmentDate;
        $this->time = $appointment[0]->appointmentSuccess->appointmentTime;
        $this->idAppointmet = $appointment[0]->appointmentSuccess->id;
        $this->openModal();
    }
    public function openModal()
    {
        $this->modal = true;
    }    
    public function salir(){
        $this->modal = false;        
    }
    public function reschedule(){
        $appointmet =  user_appointment_success::find($this->idAppointmet);
        $appointmet->update(
            [
                'appointmentDate' => $this->date,
                'appointmentTime' => $this->time
            ]
        );

    }
}
