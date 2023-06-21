<?php

namespace App\Http\Livewire\Linguistics\Modals;

use App\Models\Catalogue\Headquarter;
use App\Models\Catalogue\Schedule as CatalogueSchedule;
use App\Models\Linguistic\Linguistic;
use App\Models\Linguistic\LinguisticHistoryMovements;
use App\Models\Linguistic\LinguisticObservation;
use App\Models\Linguistic\LinguisticReserve;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Schedule extends ModalComponent
{
    use Actions;
    use WithFileUploads;
    public $scheduleId, $linguisticId;
    public $id_appoint, $name, $status, $type, $typLicense, $license_number, $red_number, $sedes, $sede, $hoursReserve, $dateReserve, $schedulelinguistics;
    public $linguistic_schedule_id, $selectedOption, $comment, $comment_cancelate, $to_user_headquarters, $date, $comment1, $comment2;
    public function rules()
    {
        return [
            'comment' => '',
            'comment_cancelate' => '',
            'selectedOption' => 'required',
            'to_user_headquarters' => '',
            'linguistic_schedule_id' => ''
        ];
    }

    public function mount($scheduleId, $linguisticId)
    {
        $this->scheduleId = $scheduleId;
        $this->linguisticId = $linguisticId;
        $this->valores($this->scheduleId);
        $this->sedes = Headquarter::where('system_id', 2)->where('status', false)->get();
        $this->schedulelinguistics = collect();
        Date::setLocale('ES');
        $this->date = Date::now()->parse();
    }
    public function render()
    {
        return view('livewire.linguistics.modals.schedule');
    }
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
    public function updatedToUserHeadquarters($value)
    {
        // Obtener los horarios disponibles para la fecha especificada
        $this->schedulelinguistics = CatalogueSchedule::where('user_id', $value)
            ->get();
    }
    public function valores($cheduleId)
    {
        $this->scheduleId = $cheduleId;
        $linguisticReserves = LinguisticReserve::with([
            'linguisticReserveFromUser',
            'linguisticReserve',
            'linguisticReserveSchedule'
        ])->where('id', $this->scheduleId)->get();

        $this->name = $linguisticReserves[0]->linguisticReserveFromUser->name . ' ' .
            $linguisticReserves[0]->linguisticReserveFromUser->UserParticipant[0]->apParental . ' ' .
            $linguisticReserves[0]->linguisticReserveFromUser->UserParticipant[0]->apMaternal;
        $this->type = $linguisticReserves[0]->linguisticReserve->linguisticTypeExam->name;
        $this->typLicense = $linguisticReserves[0]->linguisticReserve->linguisticTypeLicense->name;
        $this->license_number = $linguisticReserves[0]->linguisticReserve->license_number;
        $this->red_number = $linguisticReserves[0]->linguisticReserve->red_number;
        $this->sede = $linguisticReserves[0]->linguisticUserHeadquers->name;
        $this->dateReserve = $linguisticReserves[0]->date_reserve;
        $this->hoursReserve = $linguisticReserves[0]->linguisticReserveSchedule->time_start;
        $this->status = $linguisticReserves[0]->status;
        $this->id_appoint = $linguisticReserves[0]->id;

        if (empty($linguisticReserves[0]->reserveObserv[0]->observation)) {
            $this->comment;
        } else {
            if (!empty($linguisticReserves[0]->reserveObserv[0]->observation)) {

                if ($linguisticReserves[0]->reserveObserv[0]->status == 2) {
                    $comn = 'CANCELADO';
                } else {
                    $comn = 'REAGENDADO';
                }
                $this->comment1 = $comn . ': ' . $linguisticReserves[0]->reserveObserv[0]->observation;
            } else {
                $this->comment1;
            }
            if (!empty($linguisticReserves[0]->reserveObserv[1]->observation)) {

                if ($linguisticReserves[0]->reserveObserv[1]->status == 2) {
                    $comn = 'CANCELADO';
                } else {
                    $comn = 'REAGENDADO';
                }
                $this->comment2 = ' / ' . $comn . ': ' . $linguisticReserves[0]->reserveObserv[1]->observation;
            } else {
                $this->comment2;
            }
            $this->comment = $this->comment1 . '' . $this->comment2;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function reschedules()
    {
        //ASISTIÓ
        if ($this->selectedOption == 1) {

            $attendeReserve = LinguisticReserve::find($this->scheduleId);
            $attendeReserve->update([
                'status' => $this->selectedOption,
            ]);
            $this->emit('attendeReserve');
            $accion = 'VALIDO CITA';
            //CANCELO EL ADMIN
        } elseif ($this->selectedOption == 2) {

            $this->validate([
                'comment_cancelate' => 'required',
            ]);
            $observation = new LinguisticObservation();
            $observation->linguistic_reserve_id = $this->scheduleId;
            $observation->observation = $this->comment_cancelate;
            $observation->status = 2;
            $observation->save();
            $cancelReserve = LinguisticReserve::find($this->scheduleId);
            $cancelReserve->update([
                'status' => $this->selectedOption,
            ]);
            $this->emit('cancelReserve');
            $accion = 'CANCELO CITA';
            //REAGENDO
        } elseif ($this->selectedOption == 4) {
            $accion = 'REAGENDO CITA';
            $this->validate([
                'comment' => 'required',
                'to_user_headquarters' => 'required',
                'linguistic_schedule_id' => 'required'
            ]);
            $observation = new LinguisticObservation();
            $observation->linguistic_reserve_id = $this->scheduleId;
            $observation->observation = $this->comment;
            $observation->status = 4;
            $observation->save();
            $citas = LinguisticReserve::where('to_user_headquarters', $this->to_user_headquarters)
                ->where('date_Reserve', $this->dateReserve)
                ->where(function ($query) {
                    $query->where('status', 0)
                        ->orWhere('status', 1)
                        ->orWhere('status', 4);
                })
                ->count();
            switch ($this->to_user_headquarters) {
                case 7: // CIUDAD DE MEXICO
                    $maxCitas = 50;
                    break;
                case 2: // CANCUN
                case 3: // TIJUANA
                case 4: // TOLUCA
                case 5: // MONTERREY
                case 518: //MAZATLAN SINALOA
                case 519: //CHIAPAS
                case 520: //VERACRUZ
                case 521: //HERMOSILLO SONORA
                    $maxCitas = 10;
                    break;
                case 522: //QUERETARO
                    $maxCitas = 10;
                    break;
                case 7958: //SINALOA CULIACAN
                    $maxCitas = 10;
                    break;
                case 6: // GUADALAJARA
                    $maxCitas = 20;
                    break;
                case 523: // YUCATAN
                    $maxCitas = 5;
                    break;
                default:
                    $maxCitas = 0;
                    break;
            }
            if ($citas >= $maxCitas) {
                $this->notification([
                    'title'       => 'CITA NO GENERADA!',
                    'description' => 'No hay citas disponibles para ese dia',
                    'icon'        => 'error'
                ]);
            } else {
                $cita = LinguisticReserve::find($this->scheduleId);
                $cita->to_user_headquarters = $this->to_user_headquarters;
                $cita->date_Reserve = $this->dateReserve;
                $cita->status = $this->selectedOption;
                $cita->save();
                $this->emit('reserveAppointment');
            }
        } else {
            $this->validate();
        }
        //Historial de validar cita
        LinguisticHistoryMovements::create([
            'user_id' => Auth::user()->id,
            'action' => $accion,
            'process' => $this->name . ' FOLIO CITA:' . $this->id_appoint
        ]);
        $this->closeModal();
    }
    public function saveActive()
    {
        $activeReserve = Linguistic::find($this->linguisticId);
        $activeReserve->update([
            'reference_number' => 'ACTIVE' . '-' . $this->linguisticId,
        ]);
        $updateStatus = LinguisticReserve::find($this->scheduleId);
        $updateStatus->update([
            'status' => '5',
        ]);
        $this->notification([
            'title'       => 'LLAVE DE PAGO LIBERADA!',
            'description' => 'La llave de pago se liberó.',
            'icon'        => 'info',
            'timeout' => '3100'
        ]);
        $this->closeModal();
        $this->emit('reserveAppointment');
        //Historial de liberar llave de pago
        LinguisticHistoryMovements::create([
            'user_id' => Auth::user()->id,
            'action' => "LIBERA LLAVE DE PAGO",
            'process' => $this->name . ' FOLIO CITA:' . $this->id_appoint
        ]);
        $this->closeModal();
    }
    public function messages()
    {
        return [
            'comment_cancelate.required' => 'Campo obligatorio',
            'comment.required' => 'Campo obligatorio',
            'selectedOption.required' => 'Seleccione opción',
            'to_user_headquarters.required' => 'Seleccione opción',
            'linguistic_schedule_id.required' => 'Seleccione opción'
        ];
    }
}
