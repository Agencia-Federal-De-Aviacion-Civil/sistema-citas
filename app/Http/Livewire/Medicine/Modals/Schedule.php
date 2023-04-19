<?php

namespace App\Http\Livewire\Medicine\Modals;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\MedicineObservation;
use App\Models\Medicine\MedicineReserve;
use App\Models\Medicine\MedicineSchedule;
use App\Models\Observation;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\Modal;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Schedule extends ModalComponent
{
    use Actions;
    use WithFileUploads;
    public $scheduleId, $status, $medicineReserves, $name, $type, $class, $typLicense, $sede, $dateReserve, $date, $time, $scheduleMedicines, $sedes,
        $to_user_headquarters, $medicine_schedule_id, $selectedOption, $comment, $attended;
    public function mount($scheduleId)
    {
        $this->scheduleId = $scheduleId;
        $this->valores($this->scheduleId);
        $this->sedes = Headquarter::where('system_id', 1)->get();
        $this->scheduleMedicines = collect();
        Date::setLocale('ES');
        $this->date = Date::now()->parse();
    }
    public function render()
    {
        return view('livewire.medicine.modals.schedule');
    }
    public function valores($cheduleId)
    {
        $this->scheduleId = $cheduleId;
        $medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])
            ->where('id', $this->scheduleId)->get();
        $this->name = $medicineReserves[0]->medicineReserveMedicine->medicineUser->name . ' ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant[0]->apParental . ' ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant[0]->apMaternal;
        $this->type = $medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->name;

        if ($medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->id == 1) {
            $this->class = $medicineReserves[0]->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name;
            $this->typLicense = $medicineReserves[0]->medicineReserveMedicine->medicineInitial[0]->medicineInitialClasificationClass->name;
        } else if ($medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->id == 2) {
            $this->class = $medicineReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name;
            $this->typLicense = $medicineReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationClasificationClass->name;
        }
        $this->to_user_headquarters = $medicineReserves[0]->user->name;
        $this->dateReserve = $medicineReserves[0]->dateReserve;

        $this->status = $medicineReserves[0]->status;
    }

    public function reschedules()
    {
        if ($this->selectedOption == 1) {
           
            $attendeReserve = MedicineReserve::find($this->scheduleId);
            $attendeReserve->update([
                'status' => $this->attended,
            ]);
            $this->emit('attendeReserve');

        } elseif ($this->selectedOption == 2) {
            $observation = new MedicineObservation();
            $observation->medicine_reserve_id = $this->scheduleId;
            $observation->observation = $this->comment;
            $observation->save();
            $cancelReserve = MedicineReserve::find($this->scheduleId);
            $cancelReserve->update([
                'status' => $this->selectedOption,
            ]);
            $this->emit('cancelReserve');
        } elseif ($this->selectedOption == 4) {
        }
        $this->closeModal();
    }
}
