<?php

namespace App\Http\Livewire\Medicine\AuthorizedThird\Appointments;

use App\Models\Catalogue\Municipal;
use App\Models\Catalogue\State;
use App\Models\UserParticipant;
use Jenssegers\Date\Date;
use Livewire\Component;
use WireUi\Traits\Actions;

class ScheduleAppointments extends Component
{
    public $dateNow,$states, $municipals;
    public $curp_search,$userParticipant,$status,$title;
    public $user_id, $id_register,$name_search,$apParental_search,$apMaternal_search,$curp_searchs,$email_search, $name, $apParental, $apMaternal, $genre, $birth, $state_id, $municipal_id, $age, $street, $nInterior, $nExterior, $suburb, $postalCode, $federalEntity,
    $delegation, $mobilePhone, $officePhone, $extension, $curp, $email, $password = '', $passwordConfirmation = '';
    public function mount()
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');
        $this->states = State::all();
        $this->municipals = collect();
    }
    
    public function render()
    {
        return view('livewire.medicine.authorized-third.appointments.schedule-appointments');
    }
    public function updatedStateId($id)
    {
        $this->municipals = Municipal::with('municipalState')->where('state_id', $id)->get();
    }

    public function searchcurp()
    {
        $this->userParticipant = UserParticipant::with('userParticipantUser')->where('curp', $this->curp_search)->get();
        if(count( $this->userParticipant) == 1) {
            $this->status ='1';
            $this->title ='VERIFICAR DATOS';
            $this->name_search = $this->userParticipant[0]->apParental;
            $this->apParental = $this->userParticipant[0]->apParental;
            $this->apMaternal = $this->userParticipant[0]->apMaternal_search;
            $this->curp_searchs = $this->userParticipant[0]->curp;
            $this->email_search = $this->userParticipant[0]->email;
        }else{
            $this->status ='2';
            $this->title ='REGISTAR USUARIO';
        }

    }
}
