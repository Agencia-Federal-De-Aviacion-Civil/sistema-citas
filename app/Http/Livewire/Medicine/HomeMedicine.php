<?php

namespace App\Http\Livewire\Medicine;

use App\Models\Catalogue\ClasificationClass;
use App\Models\Catalogue\Headquarter;
use App\Models\Catalogue\TypeClass;
use App\Models\Catalogue\TypeExam;
use App\Models\Document;
use App\Models\Medicine\Medicine;
use App\Models\Medicine\MedicineDisabledDays;
use App\Models\Medicine\MedicineInitial;
use App\Models\Medicine\MedicineQuestion;
use App\Models\Medicine\MedicineRenovation;
use App\Models\Medicine\MedicineReserve;
use App\Models\Medicine\MedicineSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Jenssegers\Date\Date;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use PDF;

class HomeMedicine extends Component
{
    use Actions;
    use WithFileUploads;
    public $medicine_question_id, $type_class_id, $clasificationClass, $clasification_class_id;
    public $name_document, $reference_number, $pay_date, $type_exam_id, $typeRenovationExams, $dateConvertedFormatted;
    public $questionClassess, $typeExams, $sedes, $userQuestions, $to_user_headquarters, $dateReserve, $saveMedicine, $disabledDaysFilter;
    public $confirmModal = false, $modal = false;
    public $medicineQueries, $medicineReserves, $medicineInitials, $medicineRenovations, $id_medicineReserve, $savedMedicineId, $scheduleMedicines, $medicine_schedule_id;
    // MEDICINE INITIAL TABLE
    public $question, $date, $dateNow;
    protected $listeners = [
        'saveDisabledDays' => '$refresh',
    ];
    public function mount()
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');
        $this->typeExams = TypeExam::all();
        $this->sedes = Headquarter::where('system_id', 1)->get();
        $this->userQuestions = MedicineQuestion::all();
        $this->questionClassess = collect();
        $this->clasificationClass = collect();
        $this->typeRenovationExams = collect();
        $this->scheduleMedicines = collect();
        $this->disabledDaysFilter = collect();

        // $this->dateNow = Date::now()->format('Y-m-d');
    }
    public function rules()
    {
        return [
            'name_document' => 'required',
            // 'reference_number' => 'required',
            'reference_number' => 'required|unique:medicines',
            'pay_date' => 'required',
            'type_exam_id' => 'required',
            'medicine_question_id' => 'required_if:type_exam_id,1',
            'type_class_id' => 'required',
            'clasification_class_id' => 'required',
            'to_user_headquarters' => 'required',
            'dateReserve' => 'required',
            'medicine_schedule_id' => 'required'
        ];
    }
    public function render()
    {
        // dump($this->to_user_headquarters);
        // $disabledDays = MedicineDisabledDays::pluck('disabled_days')->toArray();
        // TODO ESTE CODIGO FUNCIONA
        // dd($disabledDaysyes = MedicineDisabledDays::pluck('disabled_days'));
        // $isDisabled = in_array($this->dateNow, $disabledDays);
        // TODO NUEVO ALGORITMO
        return view('livewire.medicine.home-medicine')
            ->layout('layouts.app');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function clean()
    {
        $this->reset([
            'name_document',
            'reference_number',
            'pay_date',
            'type_exam_id',
            'medicine_question_id',
            'type_class_id',
            'clasification_class_id',
            'medicine_question_id',
        ]);
    }
    public function updatedMedicineQuestionId($medicine_question_id)
    {
        $this->questionClassess = TypeClass::where('medicine_question_id', $medicine_question_id)->get();
    }
    public function updatedTypeExamId($type_exam_id)
    {
        $this->typeRenovationExams = TypeClass::where('type_exam_id', $type_exam_id)->get();
    }
    public function updatedTypeClassId($type_class_id)
    {
        $this->clasificationClass = ClasificationClass::where('type_class_id', $type_class_id)->get();
    }
    public function resetClasificationClass()
    {
        $this->clasificationClass = [];
    }
    public function resetQuestions()
    {
        $this->medicine_question_id = [];
    }
    public function openModal()
    {
        $this->confirmModal = true;
    }
    public function updatedToUserHeadquarters($value)
    {
        $this->dateReserve = '';
        // Obtener los horarios disponibles para la fecha especificada
        $this->scheduleMedicines = MedicineSchedule::where('user_id', $value)
            ->where('max_schedules', 0)
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
    public function searchDisabledDays()
    {
        $value = $this->to_user_headquarters;
        $disabledDays = MedicineDisabledDays::where('user_headquarters_id', $value)->pluck('disabled_days');
        $disabledDaysArray = [];

        foreach ($disabledDays as $days) {
            $daysArray = array_map('trim', explode(',', $days));
            $disabledDaysArray = array_merge($disabledDaysArray, $daysArray);
        }
        $this->disabledDaysFilter = $disabledDaysArray;
        $this->dispatchBrowserEvent('headquartersUpdated', [
            'disabledDaysFilter' => $disabledDaysArray
        ]);
    }
    // public function updatedDateReserve($value)
    // {
    //     $this->scheduleMedicines = MedicineSchedule::where('user_id', $this->to_user_headquarters)
    //         ->whereNotIn('id', function ($query) use ($value) {
    //             $query->select('medicine_schedule_id')
    //                 ->from('medicine_reserves')
    //                 ->where('to_user_headquarters', $this->to_user_headquarters)
    //                 ->where('dateReserve', $value);
    //         })
    //         ->orderBy('time_start')
    //         ->get();
    // }
    public function openModalPdf()
    {
        $this->confirmModal = false;
        $this->modal = true;
    }
    public function returnDashboard()
    {
        return redirect()->route('afac.home');
    }
    public function downloadpdf()
    {
        return response()->download(public_path('documents/Formatos_Cita_medica.pdf'));
    }
    public function save()
    {
        $this->validate();
        $citas = MedicineReserve::where('to_user_headquarters', $this->to_user_headquarters)
            // ->where('medicine_schedule_id', $this->medicine_schedule_id)
            ->where('dateReserve', $this->dateReserve)
            ->where(function ($query) {
                $query->where('status', 0)
                    ->orWhere('status', 1)
                    ->orWhere('status', 4);
            })
            ->count();
        // dd($citas);
        switch ($this->to_user_headquarters) {
            case 7: // CIUDAD DE MEXICO
                $maxCitas = 50;
                break;
            case 2: // CANCUN
            case 3: // TIJUANA
            case 4: // TOLUCA
            case 5: // MONTERREY
            case 528: //MAZATLAN SINALOA
            case 529: //CHIAPAS
            case 530: //VERACRUZ
            case 531: //HERMOSILLO SONORA
            case 532: //QUERETARO
                $maxCitas = 10;
                break;
            case 6: // GUADALAJARA
                $maxCitas = 20;
                break;
            case 533: // YUCATAN
                $maxCitas = 5;
                break;
            default:
                $maxCitas = 0;
                break;
        }
        // $schedule = MedicineSchedule::find($this->medicine_schedule_id);
        $userMedicines = MedicineReserve::with(['medicineReserveMedicine'])
            ->whereHas('medicineReserveMedicine', function ($q1) {
                $q1->where('user_id', Auth::user()->id);
            })
            ->where(function ($q) {
                $q->whereHas('medicineReserveMedicine.medicineInitial', function ($q2) {
                    $q2->where('type_class_id', $this->type_class_id);
                })
                    ->orWhereHas('medicineReserveMedicine.medicineRenovation', function ($q2) {
                        $q2->where('type_class_id', $this->type_class_id);
                    });
            })
            ->where(function ($queryStop) {
                $queryStop->where('status', 0)
                    ->orWhere('status', 4);
            })
            ->get();
        // dd($userMedicines);
        foreach ($userMedicines as $userMedicine) {
            if ($userMedicine->id) {
                if ($userMedicine->medicineReserveMedicine->medicineInitial->count() > 0 && $userMedicine->medicineReserveMedicine->medicineInitial[0]->type_class_id == $this->type_class_id) {
                    $this->notification([
                        'title'       => 'ERROR DE CITA!',
                        'description' => 'YA TIENES UNA CITA AGENDADA PARA EXAMEN INICIAL' . ' ' . $userMedicine->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name,
                        'icon'        => 'error',
                        'timeout' => '3100'
                    ]);
                    return;
                } else if ($userMedicine->medicineReserveMedicine->medicineRenovation->count() > 0 && $userMedicine->medicineReserveMedicine->medicineRenovation[0]->type_class_id == $this->type_class_id) {
                    $this->notification([
                        'title'       => 'ERROR DE CITA!',
                        'description' => 'YA TIENES UNA CITA AGENDADA PARA EXAMEN DE RENOVACIÓN' . ' ' . $userMedicine->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name,
                        'icon'        => 'error',
                        'timeout' => '2500'
                    ]);
                    return;
                }
            }
        }
        // $maxCitasHorario = $schedule->max_schedules;
        //  if ($citas >= $maxCitas || $citas >= $maxCitasHorario) ALFORITMO QUE SEPARA CITAS POR HORAS
        if ($citas >= $maxCitas) {
            $this->notification([
                'title'       => 'ERROR DE CITA!',
                'description' => 'No hay citas disponibles para ese dia',
                'icon'        => 'error'
            ]);
        } else {
            $extension = $this->name_document->extension();
            $saveDocument = Document::create([
                'name_document' => '123456',
                //$this->name_document->storeAs('uploads/citas-app/medicine', $this->reference_number . '-' . $this->pay_date .  '.' . $extension, 'do'),
            ]);
            $this->saveMedicine = Medicine::create([
                'user_id' => Auth::user()->id,
                'reference_number' => $this->reference_number,
                'pay_date' => $this->pay_date,
                'document_id' => $saveDocument->id,
                'type_exam_id' => $this->type_exam_id
            ]);
            if ($this->type_exam_id == 1) {
                $clasification_class_ids = $this->clasification_class_id;
                if (is_array($clasification_class_ids)) {
                    foreach ($clasification_class_ids as $clasifications) {
                        MedicineInitial::create([
                            'medicine_id' => $this->saveMedicine->id,
                            'medicine_question_id' => $this->medicine_question_id,
                            'type_class_id' => $this->type_class_id,
                            'clasification_class_id' => $clasifications
                        ]);
                    }
                } else {
                    MedicineInitial::create([
                        'medicine_id' => $this->saveMedicine->id,
                        'medicine_question_id' => $this->medicine_question_id,
                        'type_class_id' => $this->type_class_id,
                        'clasification_class_id' => $clasification_class_ids
                    ]);
                }
            } else if ($this->type_exam_id == 2) {
                foreach ($this->clasification_class_id as $clasifications) {
                    MedicineRenovation::create([
                        'medicine_id' => $this->saveMedicine->id,
                        'type_class_id' => $this->type_class_id,
                        'clasification_class_id' => $clasifications
                    ]);
                }
            }
            $cita = new MedicineReserve();
            $cita->from_user_appointment = Auth::user()->id;
            $cita->medicine_id = $this->saveMedicine->id;
            $cita->to_user_headquarters = $this->to_user_headquarters;
            $cita->dateReserve = $this->dateReserve;
            $cita->medicine_schedule_id = $this->medicine_schedule_id;
            $cita->save();
            session(['saved_medicine_id' => $this->saveMedicine->id]);
            $this->generatePdf();
            $this->clean();
            $this->openConfirm();
        }
    }
    public function openConfirm()
    {
        $this->medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'reserveSchedule'])
            ->where('medicine_id', $this->saveMedicine->id)->get();
        $dateConverted = $this->medicineReserves[0]->dateReserve;
        $this->dateConvertedFormatted = Date::parse($dateConverted)->format('l j F Y');
        $this->medicineInitials = MedicineInitial::with([
            'initialMedicine', 'medicineInitialQuestion', 'medicineInitialTypeClass',
            'medicineInitialClasificationClass'
        ])->where('medicine_id', $this->saveMedicine->id)->get();
        $this->medicineRenovations = MedicineRenovation::with(['renovationMedicine', 'renovationTypeClass', 'renovationClasificationClass', 'renovationClasificationClass'])
            ->where('medicine_id', $this->saveMedicine->id)->get();
        $this->confirmModal = true;
    }
    public function deleteRelationShip()
    {
        $this->confirmModal = false;
        $this->dialog()->confirm([
            'title'       => '¡ATENCIÓN!',
            'description' => '¿ESTAS SEGURO DE CANCELAR ESTA CITA?',
            'icon'        => 'info',
            'accept'      => [
                'label'  => 'SI',
                'method' => 'confirmDelete',
            ],
            'reject' => [
                'label'  => 'NO',
                'method' => 'openModal',
            ],
        ]);
    }
    public function delete($idUpdate)
    {
        MedicineReserve::find($idUpdate);
        $this->id_medicineReserve = $idUpdate;
        $this->deleteRelationShip();
    }
    public function confirmDelete()
    {
        $updateReserve = MedicineReserve::find($this->id_medicineReserve);
        $updateReserve->update([
            'status' => 3
        ]);
        $this->notification([
            'title'       => 'CITA CANCELADA ÉXITOSAMENTE',
            'icon'        => 'error',
            'timeout' => '3100'
        ]);
    }
    public function generatePdf()
    {
        $savedMedicineId = session('saved_medicine_id');
        $medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])
            ->where('medicine_id', $savedMedicineId)->get();
        $medicineId = $medicineReserves[0]->medicine_id;
        $dateAppointment = $medicineReserves[0]->dateReserve;
        $dateConvertedFormatted = Date::parse($dateAppointment)->format('l j F Y');
        $curp = $medicineReserves[0]->medicineReserveMedicine->medicineUser->userParticipant->pluck('curp')->first();
        $keyEncrypt =  Crypt::encryptString($medicineId . '*' . $dateAppointment . '*' . $curp);
        $fileName = $medicineReserves[0]->dateReserve . '-' . $curp . '-' . 'MED-' . $medicineId . '.pdf';
        if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 1) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-initial', compact('medicineReserves', 'keyEncrypt', 'dateConvertedFormatted'));
            return $pdf->download($fileName);
        } else if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 2) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-renovation', compact('medicineReserves', 'keyEncrypt', 'dateConvertedFormatted'));
            return $pdf->download($fileName);
        }
    }
    public function messages()
    {
        return [
            'type_exam_id.required' => 'Campo obligatorio',
            'type_class_id.required' => 'Campo obligatorio',
            'medicine_schedule_id.required' => 'Campo obligatorio',
            'reference_number.unique' => 'Referencia de pago ya existe.',
            'clasification_class_id.required' => 'Campo obligatorio',
            'paymentConcept.required' => 'Ingrese clave de pago.',
            'paymentConcept.unique' => 'Concepto de pago ya registrado, intenta con otro.',
            'paymentDate.required' => 'Campo obligatorio.',
            'document.required' => 'Documento obligatorio.',
            'document.mimetypes' => 'Solo documentos .PDF.',
            'document.max' => 'No permitido, tamaño maximo 500 KB',
        ];
    }
}
