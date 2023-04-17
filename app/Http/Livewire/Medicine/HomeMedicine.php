<?php

namespace App\Http\Livewire\Medicine;

use App\Models\Catalogue\ClasificationClass;
use App\Models\Catalogue\Headquarter;
use App\Models\Catalogue\TypeClass;
use App\Models\Catalogue\TypeExam;
use App\Models\Document;
use App\Models\Medicine\Medicine;
use App\Models\Medicine\MedicineInitial;
use App\Models\Medicine\MedicineQuestion;
use App\Models\Medicine\MedicineRenovation;
use App\Models\Medicine\MedicineReserve;
use App\Models\Medicine\MedicineSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use PDF;

class HomeMedicine extends Component
{
    use Actions;
    use WithFileUploads;
    public $medicine_question_id, $type_class_id, $clasificationClass, $clasification_class_id;
    public $name_document, $reference_number, $pay_date, $type_exam_id, $typeRenovationExams;
    public $questionClassess, $typeExams, $sedes, $userQuestions, $to_user_headquarters, $dateReserve, $saveMedicine;
    public $confirmModal = false, $modal = false;
    public $medicineQueries, $medicineReserves, $medicineInitials, $medicineRenovations, $id_medicineReserve, $savedMedicineId, $scheduleMedicines, $medicine_schedule_id;
    // MEDICINE INITIAL TABLE
    public $question, $date;
    public function mount()
    {
        $this->typeExams = TypeExam::all();
        $this->sedes = Headquarter::where('system_id', 1)->get();
        $this->userQuestions = MedicineQuestion::all();
        $this->questionClassess = collect();
        $this->clasificationClass = collect();
        $this->typeRenovationExams = collect();
        $this->scheduleMedicines = collect();
        Date::setLocale('ES');
        $this->date = Date::now()->parse();
    }
    public function rules()
    {
        return [
            'name_document' => 'required',
            'reference_number' => 'required',
            'pay_date' => 'required',
            'type_exam_id' => 'required',
            'medicine_question_id' => 'required_if:type_exam_id,1',
            'type_class_id' => '',
            'clasification_class_id' => '',
            'to_user_headquarters' => 'required',
            'dateReserve' => 'required'
        ];
    }
    public function render()
    {
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
        // Obtener los horarios disponibles para la fecha especificada
        $this->scheduleMedicines = MedicineSchedule::where('user_id', $value)
            ->whereNotIn('id', function ($query) {
                // Subconsulta para obtener los horarios reservados
                $query->select('medicine_schedule_id')
                    ->from('medicine_reserves')
                    ->where('dateReserve', $this->dateReserve)
                    ->groupBy('medicine_schedule_id')
                    ->havingRaw('COUNT(*) >= max_schedules');
            })
            ->get();
    }
    public function openModalPdf()
    {
        $this->confirmModal = false;
        $this->modal = true;
    }
    public function returnDashboard()
    {
        return redirect()->route('afac.home');
    }
    public function save()
    {
        $this->validate();
        $citas = MedicineReserve::where('to_user_headquarters', $this->to_user_headquarters)
            ->where('dateReserve', $this->dateReserve)
            ->where('dateReserve', $this->dateReserve)
            ->where('medicine_schedule_id', $this->medicine_schedule_id)
            ->count();
        switch ($this->to_user_headquarters) {
            case 2: // Cancun
            case 3: // Tijuana
            case 4: // Toluca
            case 5: // Monterrey
                $maxCitas = 10;
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
        $schedule = MedicineSchedule::find($this->medicine_schedule_id);
        $maxCitasHorario = $schedule->max_schedules;
        if ($citas >= $maxCitas || $citas >= $maxCitasHorario) {
            $this->notification([
                'title'       => 'ERROR DE CITA!',
                'description' => 'No hay citas disponibles para ese dia',
                'icon'        => 'error'
            ]);
        } else {
            $extension = $this->name_document->extension();
            $saveDocument = Document::create([
                'name_document' => $this->name_document->storeAs('uploads/citas-app/medicine', $this->reference_number . '-' . $this->pay_date .  '.' . $extension, 'do'),
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
        $this->medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])
            ->where('medicine_id', $this->saveMedicine->id)->get();
        $this->medicineInitials = MedicineInitial::with([
            'initialMedicine', 'medicineInitialQuestion', 'medicineInitialTypeClass',
            'medicineInitialClasificationClass'
        ])->where('medicine_id', $this->saveMedicine->id)->get();
        $this->medicineRenovations = MedicineRenovation::with(['renovationMedicine', 'renovationTypeClass', 'renovationClasificationClass'])
            ->where('medicine_id', $this->saveMedicine->id)->get();
        $this->confirmModal = true;
    }
    public function deleteRelationShip()
    {
        $this->confirmModal = false;
        $this->dialog()->confirm([
            'title'       => '¡ATENCIÓN!',
            'description' => '¿ESTAS SEGURO DE ELIMINAR ESTA CITA?',
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
    public function delete($idDelete)
    {
        MedicineReserve::findOrFail($idDelete);
        $this->id_medicineReserve = $idDelete;
        $this->deleteRelationShip();
    }
    public function confirmDelete()
    {
        MedicineReserve::find($this->id_medicineReserve)->delete();
        $this->notification([
            'title'       => 'Cita eliminada éxitosamente',
            'icon'        => 'error'
        ]);
    }
    public function generatePdf()
    {
        $savedMedicineId = session('saved_medicine_id');
        $medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])
            ->where('medicine_id', $savedMedicineId)->get();
        $curpKey = $medicineReserves[0]->medicineReserveMedicine->medicineUser->userParticipant->pluck('id')->first();
        $keyEncrypt =  Crypt::encryptString($curpKey);
        if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 1) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-initial', compact('medicineReserves', 'keyEncrypt'));
            return $pdf->download($medicineReserves[0]->dateReserve . '-' . 'cita.pdf');
        } else if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 2) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-renovation', compact('medicineReserves', 'keyEncrypt'));
            return $pdf->download($medicineReserves[0]->dateReserve . '-' . 'cita.pdf');
        }
    }
    public function messages()
    {
        return [
            'type_exam_id.required' => 'Campo obligatorio',
            'type_class_id.required' => 'Campo obligatorio',
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
