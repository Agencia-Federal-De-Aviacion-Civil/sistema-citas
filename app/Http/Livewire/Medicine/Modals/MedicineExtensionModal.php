<?php

namespace App\Http\Livewire\Medicine\Modals;

use App\Models\Catalogue\ClasificationClass;
use App\Models\Catalogue\LogsApi;
use App\Models\Catalogue\TypeClass;
use App\Models\Catalogue\TypeExam;
use App\Models\Document;
use App\Models\Medicine\MedicineQuestion;
use App\Models\Medicine\MedicineReserve;
use App\Models\Medicine\MedicineReservesExtension;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class MedicineExtensionModal extends ModalComponent
{
    use Actions;
    use WithFileUploads;
    public $scheduleId, $medicineReservesExtension, $extensionCurp, $type_exam, $type_class, $clasification_class, $inicialId,
        $id_extension, $reference_number_ext, $document_ext_id, $date_reserve_ext, $type_exam_id_extension, $medicine_question_ex_id, $clas_class_extension_id;
    public $typeExams, $userQuestions, $questionClassessExtension, $type_class_extension_id, $clasificationClassExtension, $selectedTypeClassIds, $typeClassId,
        $is_external, $id_type_class_extension, $ext_reference_number;
    public function mount($scheduleId = null)
    {
        if (isset($scheduleId)) {
            $this->typeExams = TypeExam::whereIn('id', [1, 2])->get();
            $this->userQuestions = MedicineQuestion::all();
            $this->scheduleId = $scheduleId;
            $this->medicineReservesExtension = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveMedicineExtension'])->where('id', $this->scheduleId)->get();
            $this->extensionCurp = $this->medicineReservesExtension[0]->userParticipantUser->curp;
            $this->type_exam = $this->medicineReservesExtension[0]->medicineReserveMedicineExtension[0]->extensionTypeClass->typeClassTypeExam->name ?? null;
            $this->type_class = $this->medicineReservesExtension[0]->medicineReserveMedicineExtension[0]->extensionTypeClass->name ?? null;
            $this->clasification_class = $this->medicineReservesExtension[0]->medicineReserveMedicineExtension[0]->extensionClasificationClass->name ?? null;
            $this->reference_number_ext = $this->medicineReservesExtension[0]->medicineReserveMedicineExtension[0]->reference_number_ext ?? null;
            $this->date_reserve_ext = $this->medicineReservesExtension[0]->medicineReserveMedicineExtension[0]->date_reserve_ext ?? null;
            $this->id_extension = $this->medicineReservesExtension[0]->medicineReserveMedicineExtension[0]->id ?? null;

            $this->is_external = $this->medicineReservesExtension[0]->is_external;
            $this->id_type_class_extension = $this->medicineReservesExtension[0]->medicineReserveMedicineExtension[0]->type_class_extension_id ?? '0';
            $this->ext_reference_number = $this->medicineReservesExtension[0]->medicineReserveMedicineExtension[0]->reference_number_ext ?? null;

        } else {
            $this->scheduleId = null;
        }
    }
    public function rules()
    {
        return [
            // 'reference_number_ext' => 'required',
            // 'document_ext_id' => 'required|mimetypes:application/pdf,image/jpeg,image/jpg,image/png',
            // 'date_reserve_ext' => 'required'
        ];
    }
    public function render()
    {
        return view('livewire.medicine.modals.medicine-extension-modal');
    }
    public function viewPdf()
    {
        $filePath = storage_path("app/public/" . $this->medicineReservesExtension[0]->medicineReserveMedicineExtension[0]->extensionDocument->name_document);
        $filePathName = explode('/', $filePath);
        $filePathNameDownload = $filePathName[5];
        return response()->download($filePath, $filePathNameDownload);
    }
    public function updatedMedicineQuestionExId($type_exam_id_extension)
    {
        $inicialId = isset($this->medicineReservesExtension[0]->medicineReserveMedicine->medicineInitial[0]->type_class_id)
            ? $this->medicineReservesExtension[0]->medicineReserveMedicine->medicineInitial[0]->type_class_id
            : $this->medicineReservesExtension[0]->medicineReserveMedicine->medicineRenovation[0]->type_class_id;
        $baseQuery = TypeClass::where('medicine_question_id', $type_exam_id_extension);
        if ($this->type_exam_id_extension == 1) {
            if ($this->medicine_question_ex_id == 1) {
                if ($inicialId == 1) {
                    $this->questionClassessExtension = $baseQuery->get();
                } else if ($inicialId == 2) {
                    $this->questionClassessExtension = $baseQuery->whereIn('id', [2, 3])->get();
                } else if ($inicialId == 3) {
                    $this->questionClassessExtension = $baseQuery->whereIn('id', [3])->get();
                }
                if ($inicialId == 4) {
                    $this->questionClassessExtension = $baseQuery->get();
                } else if ($inicialId == 5) {
                    $this->questionClassessExtension = $baseQuery->whereIn('id', [2, 3])->get();
                } else if ($inicialId == 6) {
                    $this->questionClassessExtension = $baseQuery->whereIn('id', [3])->get();
                }
            } else if ($this->medicine_question_ex_id == 2) {
                if ($inicialId == 1) {
                    $this->questionClassessExtension = $baseQuery->whereIn('id', [5, 6])->get();
                } else if ($inicialId == 2) {
                    $this->questionClassessExtension = $baseQuery->whereIn('id', [4, 5, 6])->get();
                } else if ($inicialId == 3) {
                    $this->questionClassessExtension = $baseQuery->whereIn('id', [6])->get();
                }
                if ($inicialId == 4) {
                    $this->questionClassessExtension = $baseQuery->whereIn('id', [5, 6])->get();
                } else if ($inicialId == 5) {
                    $this->questionClassessExtension = $baseQuery->whereIn('id', [4, 5, 6])->get();
                } else if ($inicialId == 6) {
                    $this->questionClassessExtension = $baseQuery->whereIn('id', [6])->get();
                }
            }
        }
    }
    public function updatedTypeExamIdExtension($type_exam_id_extension)
    {
        if ($type_exam_id_extension == 2) {
            $typeClassId = $this->medicineReservesExtension[0]->medicineReserveMedicine->medicineRenovation[0]->type_class_id ?? $this->medicineReservesExtension[0]->medicineReserveMedicine->medicineInitial[0]->type_class_id;
            $typeClassIds = [
                1 => [5, 6],
                2 => [5, 6],
                3 => [6],
                4 => [4, 5, 6],
                5 => [5, 6],
                6 => [6],
            ];
            if (array_key_exists($typeClassId, $typeClassIds)) {
                $baseQuery = TypeClass::where('medicine_question_id', $type_exam_id_extension);
                $this->questionClassessExtension = $baseQuery->whereIn('id', $typeClassIds[$typeClassId])->get();
            }
        }
    }
    public function updatedTypeClassExtensionId()
    {
        if ($this->type_class_extension_id) {
            $selectedTypeClassId = isset($this->medicineReservesExtension[0]->medicineReserveMedicine->medicineInitial[0]->clasification_class_id)
                ? $this->medicineReservesExtension[0]->medicineReserveMedicine->medicineInitial[0]->clasification_class_id
                : $this->medicineReservesExtension[0]->medicineReserveMedicine->medicineRenovation[0]->clasification_class_id;
            $this->clasificationClassExtension = ClasificationClass::where('type_class_id', $this->type_class_extension_id)
                ->whereNotIn('id', is_array($selectedTypeClassId) ? $selectedTypeClassId : [$selectedTypeClassId])
                ->get();
        }
    }
    public function resetClassQuestion()
    {
        $this->reset(['type_class_extension_id', 'clas_class_extension_id']);
    }
    public function resetClassExtensionId()
    {
        $this->reset(['medicine_question_ex_id', 'type_class_extension_id', 'clas_class_extension_id']);
    }
    public function saveExtension()
    {
        if ($this->is_external == 1) {

            $extensionId = MedicineReservesExtension::updateOrCreate(
                ['id' => $this->id_extension],
                [
                    'medicine_reserve_id' => $this->medicineReservesExtension[0]->id,
                    'type_class_extension_id' => $this->type_class_extension_id,
                    'clas_class_extension_id' => $this->clas_class_extension_id,
                    'document_ext_id' => null,
                    'reference_number_ext' => null,
                    'date_reserve_ext' => null
                ]
            );
        } else {

            $this->validate([
                'reference_number_ext' => 'required',
                'document_ext_id' => 'required|mimetypes:application/pdf,image/jpeg,image/jpg,image/png',
                'date_reserve_ext' => 'required'
            ]);

            $extension = $this->document_ext_id->getClientOriginalExtension();
            $fileName = $this->reference_number_ext . '.' . $extension;
            $saveDocument = Document::create([
                'name_document' => $this->document_ext_id->storeAs('documentos/medicina/extension', $fileName, 'public'),
            ]);

            if (!is_null($this->type_class_extension_id) && !is_null($this->clas_class_extension_id)) {
                $extensionId = MedicineReservesExtension::updateOrCreate(
                    ['id' => $this->id_extension],
                    [
                        'medicine_reserve_id' => $this->medicineReservesExtension[0]->id,
                        'type_class_extension_id' => $this->type_class_extension_id,
                        'clas_class_extension_id' => $this->clas_class_extension_id,
                        'document_ext_id' => $saveDocument->id,
                        'reference_number_ext' => $this->reference_number_ext,
                        'date_reserve_ext' => $this->date_reserve_ext
                    ]
                );
            } else {
                $extensionId = MedicineReservesExtension::updateOrCreate(
                    ['id' => $this->id_extension],
                    [
                        'medicine_reserve_id' => $this->medicineReservesExtension[0]->id,
                        'document_ext_id' => $saveDocument->id,
                        'reference_number_ext' => $this->reference_number_ext,
                        'date_reserve_ext' => $this->date_reserve_ext
                    ]
                );
            }
        }
        $this->closeModal();
        $this->emit('addExtension');

        $this->extensionApi($extensionId);
    }


    public function extensionApi($extensionId)
    {
        $this->type_class_extension_id = ($this->type_class_extension_id == [] ? null : $this->type_class_extension_id);
        $type_class_extension_id = ($this->type_class_extension_id <= 3) ? $this->type_class_extension_id : ['4' => 1, '5' => 2, '6' => 3][$this->type_class_extension_id];


        if ($this->is_external == 1) {
            $citas =
                [

                    'id' => $extensionId->id,
                    'medicine_reserve_id' => $this->medicineReservesExtension[0]->id,
                    'license_reason_id' => $this->type_exam_id_extension,
                    'type_class_id' => $type_class_extension_id,
                    'license_class_id' => $this->clas_class_extension_id,
                    'reference_number_ext' => null,
                    'pay_date_ext' => null,
                    'is_external' => $this->is_external

                ];
        } else {

            if (!$this->id_extension) {
                $extension = 'citaExtension?';
                $citas =
                    [
                        'id' => $extensionId->id,
                        'medicine_reserve_id' => $this->medicineReservesExtension[0]->id,
                        'license_reason_id' => $this->type_exam_id_extension,
                        'type_class_id' => $type_class_extension_id,
                        'license_class_id' => $this->clas_class_extension_id,
                        'reference_number_ext' => $this->reference_number_ext,
                        'pay_date_ext' => $this->date_reserve_ext,
                        'is_studying' =>  $this->medicine_question_ex_id,
                        'is_external' => $this->is_external
                    ];
            }else{
                $extension = 'citaupdateXtension?';
                $citas =[
                'id' => $extensionId->id,
                'medicine_reserve_id' => $this->medicineReservesExtension[0]->id,
                'reference_number_ext' => $this->reference_number_ext,
                'pay_date_ext' => $this->date_reserve_ext,
                ];

            }
        }

        if (checkdnsrr('crp.sct.gob.mx', 'A')) {
            $endpoint = env('SIMA_API_EXTENTION', null);
            $response = Http::withHeaders([
                'AuthorizationSima' => env('API_TOKEN_SIMA'),                                
                'Accept' => 'application/json'
            ])->connectTimeout(30)->post('https://siafac.afac.gob.mx/' . $extension, $citas);
            if ($response->successful()) {
                $statesSuccess = $response->json()['data'];
            } elseif ($response->successful() && $response->json()['data'] === 'NO EXITOSO') {
                $this->clean();
                $this->notification()->send([
                    'title'       => 'No se realizo registro!',
                    'description' => 'Cita no registrada.',
                    'icon'        => 'error',
                    'timeout' => '3100'
                ]);
                // https://siafac.afac.gob.mx
            } else {
                $error = $response->json()['message'];
                $this->LogsApi($curp_logs = Auth::user()->UserParticipant->first()->curp, $type = 'AGENDAR CITA', $register = $error, $description = 'ERROR AL AGENDAR REGISTRO DE CITA');
                $this->notification()->send([
                    'icon' => 'info',
                    'title' => 'AVISO!',
                    'description' => 'ERROR',
                    'timeout' => '3100'
                ]);
            }
        } else {
            $this->notification()->send([
                'icon' => 'info',
                'title' => 'Sin conexión!',
                'description' => 'No hay conexión, vuelve a intentarlo.',
                'timeout' => '3100'
            ]);
            $this->LogsApi($curp_logs = Auth::user()->UserParticipant->first()->curp, $type = 'EXTENSION', $register = 'SIN CONEXION', $description = 'No hay conexión, vuelve a intentarlo');
        }
    }
    public function LogsApi($curp_logs, $type, $register, $description)
    {
        $url = url()->previous();
        $logs =  LogsApi::create([
            'curp_logs' => $curp_logs,
            'url' => $url,
            'type' => $type,
            'register' => $register,
            'description' => $description
        ]);
    }


    public function messages()
    {
        return [
            // 'type_exam_id_extension.required' => 'Seleccione opción',
            // 'type_class_extension_id.required' => 'Seleccione opción',
            // 'clas_class_extension_id.required' => 'Seleccione opción',
            'reference_number_ext.required' => 'Campo obligatorio',
            'document_ext_id.required' => 'Campo obligatorio',
            'date_reserve_ext.required' => 'Campo obligatorio'
        ];
    }
}
