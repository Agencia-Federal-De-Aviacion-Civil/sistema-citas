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
        $to_user_headquarters, $medicine_schedule_id, $selectedOption, $comment,$hoursReserve,$observation;
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
    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return 'xl';
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

        $this->hoursReserve = $medicineReserves[0]->reserveSchedule->time_start;
        if(empty($medicineReserves[0]->reserveObserv[0]->observation)){
            $this->comment;
        }else{
            $this->comment = $medicineReserves[0]->reserveObserv[0]->observation;
        }
        $this->sede = $medicineReserves[0]->user->name;
    }
    public function updatedToUserHeadquarters($value)
    {
        // Obtener los horarios disponibles para la fecha especificada
        $this->scheduleMedicines = MedicineSchedule::where('user_id', $value)
            // ->whereNotIn('id', function ($query) {
            //     // Subconsulta para obtener los horarios reservados
            //     $query->select('medicine_schedule_id')
            //         ->from('medicine_reserves')
            //         ->where('dateReserve', $this->dateReserve)
            //         ->groupBy('medicine_schedule_id')
            //         ->havingRaw('COUNT(*) >= max_schedules');
            // })
            ->get();
    }
    public function reschedules()
    {
        if ($this->selectedOption == 1) {

            $attendeReserve = MedicineReserve::find($this->scheduleId);
            $attendeReserve->update([
                'status' => $this->selectedOption,
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
            $observation = new MedicineObservation();
            $observation->medicine_reserve_id = $this->scheduleId;
            $observation->observation = $this->comment;
            $observation->save();
            $citas = MedicineReserve::where('to_user_headquarters', $this->to_user_headquarters)
                ->where('dateReserve', $this->dateReserve)
                ->where(function ($query) {
                    $query->where('status', 0)
                        ->orWhere('status', 4);
                })
                ->count();
            // dd($citas);
            switch ($this->to_user_headquarters) {
                case 2: // Cancun
                case 3: // Tijuana
                case 4: // Toluca
                case 5: // Monterrey
                    $maxCitas = 3;
                    break;
                case 7: // Guadalajara
                    $maxCitas = 20;
                    break;
                case 9: // Ciudad de Mexico
                    $maxCitas = 50;
                    break;
                default:
                    $maxCitas = 0;
                    break;
            }
            if ($citas >= $maxCitas) {
                $this->notification([
                    'title'       => 'ERROR DE CITA!',
                    'description' => 'No hay citas disponibles para ese dia',
                    'icon'        => 'error'
                ]);
            } else {
                $cita = MedicineReserve::find($this->scheduleId);
                $cita->to_user_headquarters = $this->to_user_headquarters;
                $cita->dateReserve = $this->dateReserve;
                $cita->status = $this->selectedOption;
                $cita->save();
                $this->emit('reserveAppointment');
            }
        }
        $this->closeModal();
    }
}
