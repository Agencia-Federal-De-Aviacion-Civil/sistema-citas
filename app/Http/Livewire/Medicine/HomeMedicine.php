<?php

namespace App\Http\Livewire\Medicine;

use App\Models\Catalogue\ClasificationClass;
use App\Models\Catalogue\Headquarter;
use App\Models\Catalogue\LogsApi;
use App\Models\Catalogue\TypeClass;
use App\Models\Catalogue\TypeExam;
use App\Models\Document;
use App\Models\Medicine\Medicine;
use App\Models\Medicine\MedicineDisabledDays;
use App\Models\Medicine\MedicineInitial;
use App\Models\Medicine\MedicineQuestion;
use App\Models\Medicine\MedicineRenovation;
use App\Models\Medicine\MedicineReserve;
use App\Models\Medicine\MedicineReservesExtension;
use App\Models\Medicine\MedicineRevaluation;
use App\Models\Medicine\MedicineRevaluationInitial;
use App\Models\Medicine\MedicineRevaluationRenovation;
use App\Models\Medicine\MedicineSchedule;
use App\Models\Medicine\MedicineScheduleException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Jenssegers\Date\Date;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\OpenSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\Tenantmedicina\Document as TenantmedicinaDocument;
use App\Models\Tenantmedicina\MedRservation;
use App\Models\Tenantmedicina\MedRservationExt;
use App\Models\Tenantmedicina\MedRservationReas;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

use PDF;

class HomeMedicine extends Component
{
    use Actions;
    use WithFileUploads;

    public $name, $apParental, $apMaternal, $userId, $yearExercise, $reference_key, $operation_number, $dependency_chain, $total_paid, $openValidateModal = false;
    public $medicine_question_id, $type_class_id, $clasificationClass, $clasification_class_id, $type_exception_id;
    public $document_pay, $reference_number, $pay_date, $type_exam_id, $typeRenovationExams, $dateConvertedFormatted;
    public $questionClassess, $typeExams, $sedes, $userQuestions, $headquarter_id, $dateReserve, $saveMedicine, $disabledDaysFilter;
    public $confirmModal = false, $modal = false;
    public $medicineQueries, $medicineReserves, $medicineInitials, $medicineRenovations, $id_medicineReserve, $idMedicine, $savedMedicineId, $scheduleMedicines, $medicine_schedule_id, $medreservationsid;
    // MEDICINE INITIAL TABLE
    public $question, $date, $idTypeAppointment, $idAppointmentFull, $extensionTypeOptions;
    public $document_authorization, $type_exam_revaloration_id, $typeid, $userid, $registeredUserId, $showBannerBoolean, $extensionClassId, $type_exam_id_extension, $questionClassessExtension,
        $type_class_extension_id, $typeClassId, $selectedTypeClassIds, $clasificationClassExtension, $clas_class_extension_id, $medicine_question_ex_id, $saveMedicineid;
    protected $listeners = [
        'saveDisabledDays' => '$refresh',
        'registeredEmit',
        'showBanner'
    ];
    public function mount()
    {
        //idType 2 es para cuando la sede de terceros autorizados quiere generer cita
        $idIsExternal = (session('idType') == 2 ? 1 : session('idType'));

        $this->openValidateModal = ($idIsExternal == 1) ? true : false;

        $this->idTypeAppointment = $idIsExternal;
        $boolTypeAppointment = $this->idTypeAppointment;
        $this->idAppointmentFull = $boolTypeAppointment ? 1 : 0;
        $this->typeExams = TypeExam::when($this->idTypeAppointment, function ($query) {
            return $query->whereIn('id', [1, 2]);
        }, function ($query) {
            return $query->whereIn('id', [1, 2, 3, 4, 5]);
        })->get();
        $this->sedes = collect();
        $this->userQuestions = MedicineQuestion::all();
        $this->questionClassess = collect();
        $this->clasificationClass = collect();
        $this->typeRenovationExams = collect();
        $this->scheduleMedicines = collect();
        $this->disabledDaysFilter = collect();

        $this->yearExercise = Carbon::now()->year;
        $this->reference_key = '126000812';
        $authUser =  is_null($this->userId) ? Auth::user()->load('UserParticipant')->UserParticipant : User::with([
            'UserParticipant:id,user_id,apParental,apMaternal'
        ])->find($this->userId);

        $this->name = Auth::user()->name;
        $this->apParental = Auth::user()->UserParticipant->first()->apParental;
        $this->apMaternal = Auth::user()->UserParticipant->first()->apMaternal;

        // if (Auth::user()->UserParticipant->first()->curp=='CANR950626HZSRXB04') {

        //     $this->openValidateModal = true;
            // $this->name = 'YONI GUADALUPE';
            // $this->apParental = 'CRUZ';
            // $this->apMaternal = 'BALLESTEROS';
            // $this->pay_date = '2024-07-02';
            // $this->operation_number = '800642';
            // $this->dependency_chain = '00442510033177';
            // $this->total_paid = '2104';
            // $this->reference_number = 'A82ADDB476';
        // }

    }
    public function registeredEmit($payload)
    {
        $this->registeredUserId = $payload;
    }
    public function showBanner($payload)
    {
        $this->showBannerBoolean = $payload;
    }
    public function rules()
    {
        $rules = [
            'type_exam_id' => 'required',
            'medicine_question_id' => 'required_if:type_exam_id,1',
            'type_class_id' => 'required',
            'document_authorization' => 'required_if:type_exam_id,3',
            'type_exam_revaloration_id' => 'required_if:type_exam_id,3',
            'clasification_class_id' => 'required',
            'headquarter_id' => 'required',
            'dateReserve' => 'required',
            'medicine_schedule_id' => 'required',
            'extensionClassId' => ''
        ];
        if (!$this->idTypeAppointment) {
            $rules['document_pay'] = 'required|mimetypes:application/pdf|max:5000';
            $rules['reference_number'] = 'required|unique:medicines';
            $rules['pay_date'] = 'required';
            // $rules['document_pay'] = '';
            // $rules['reference_number'] = '';
            // $rules['pay_date'] = '';
        }
        return $rules;
    }
    public function render()
    {
        return view('livewire.medicine.home-medicine');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function searchKey()
    {
        $this->validate([
            'name' => 'required',
            'apParental' => 'required',
            'apMaternal' => 'nullable',
            'pay_date' => 'required',
            // 'own_name' => 'required',
            // 'business_name' => 'required',
            'yearExercise' => 'required',
            'operation_number' => 'required',
            'total_paid' => 'required',
            'dependency_chain' => 'required',
            'reference_key' => 'required',
            'reference_number' => [
                'required',
                Rule::unique('medicines', 'reference_number'),
                // Rule::unique('medical_history_pays', 'paymentkey')->whereNull('deleted_at'),
            ],
        ]);
        $pay_date = $this->pay_date;
        // dump($payDate);
        $payDate = Carbon::parse($pay_date)->format('dmY');
        if (checkdnsrr('pagos.sct.gob.mx', 'A')) {
            // $pay_for = $this->kind_person_id == 1 ? 'PA=' . Str::upper($this->apParental) . '&MA=' . Str::upper($this->apMaternal) .
            //     '&NOM=' . Str::upper($this->name) : 'RZ=' . Str::upper($this->business_name);
            $pay_for = 'PA=' . Str::upper($this->apParental) . '&MA=' . Str::upper($this->apMaternal) . '&NOM=' . Str::upper($this->name);
            $response = Http::withHeaders([
                'api-key' =>
                // env('API_KEY_PAY'),
                '7e4eb982-5854-43c2-9583-3af45c2e2620',
                'Accept' => 'application/json'
            ])->connectTimeout(30)->get('http://pagos.sct.gob.mx/api/valida/pago?' . $pay_for . '&NUMOP=' . $this->operation_number . '&FECHA=' . $payDate . '&TOTAL=' . $this->total_paid . '&LLAVE=' .
                Str::upper($this->reference_number) . '&CADENA=' . $this->dependency_chain . '&CLAVE=126000812' . '&EJERCICIO=' . $this->yearExercise);
            if ($response->successful()) {
                $this->notification([
                    'title'       => 'PAGO VERIFICADO',
                    'description' => 'EL PAGO SE HA VERIFICADO CORRECTAMENTE',
                    'icon'        => 'success',
                    'timeout' => '2500'
                ]);
                $this->openValidateModal = true;
                Session::put(['referenceNumber' => $this->reference_number]);
            } else {
                $this->notification([
                    'title'       => 'SOLICITUD NO PROCESADA',
                    'description' => 'LA SOLICITUD NO FUE PROCESADA',
                    'icon'        => 'error',
                    'timeout' => '2500'
                ]);
            }
        } else {
            $this->notification([
                'title'       => 'ERROR DE CONEXIÓN',
                'description' => 'VERIFICA TU CONEXIÓN A INTERNET',
                'icon'        => 'error',
                'timeout' => '2500'
            ]);
        }
    }

    public function clean()
    {
        $this->reset([
            'document_authorization',
            'document_pay',
            'reference_number',
            'pay_date',
            'type_exam_id',
            'medicine_question_id',
            'type_class_id',
            'clasification_class_id',
            'medicine_question_id',
            'headquarter_id',
            'dateReserve',
            'medicine_schedule_id'
        ]);
    }
    public function updatedMedicineQuestionId($medicine_question_id)
    {
        $this->questionClassess = TypeClass::where('medicine_question_id', $medicine_question_id)->get();
    }
    public function updatedTypeExamId($type_exam_id)
    {
        $type_exam_id_to_use = in_array($type_exam_id, ['3', '4', '5']) ? '2' : $type_exam_id;
        $this->typeRenovationExams = TypeClass::where('type_exam_id', $type_exam_id_to_use)->get();
        if ($type_exam_id === '4') {
            // SOLO SEDE CIUDAD DE MÉXICO
            $this->sedes = Headquarter::where('system_id', 1)->where('status', false)->where('id', 6)->get();
        } else {
            $idHeadquarter = session('idHeadquarter');
            $this->sedes = Headquarter::with('HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                ->when($this->idTypeAppointment, function ($query) use ($idHeadquarter) {
                    return $query->where('id', $idHeadquarter);
                }, function ($query) use ($idHeadquarter) {
                    return $query->where('id', $idHeadquarter);
                })
                ->orWhere(function ($query) use ($idHeadquarter) {
                    if (!$idHeadquarter) {
                        $query->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($subquery) {
                            $subquery->where('user_id', Auth::user()->id);
                        });
                    }
                })->where('system_id', 1)->where('status', false)->get();
            // $this->sedes = Headquarter::where('system_id', 1)->where('status', false)->get();
        }
    }
    // TODO ES NECESARIO REFACTORIZAR EL CODIGO
    public function updatedMedicineQuestionExId($type_exam_id_extension)
    {
        $baseQuery = TypeClass::where('medicine_question_id', $type_exam_id_extension);
        if ($this->type_exam_id == 1 && $this->medicine_question_id == 1) {
            if ($type_exam_id_extension == 1) {
                if ($this->medicine_question_ex_id == 1) {
                    if ($this->type_class_id == 1) {
                        $this->questionClassessExtension = $baseQuery->get();
                    } else if ($this->type_class_id == 2) {
                        $this->questionClassessExtension = $baseQuery->whereIn('id', [2, 3])->get();
                    } else if ($this->type_class_id == 3) {
                        $this->questionClassessExtension = $baseQuery->whereIn('id', [3])->get();
                    }
                }
            } else if ($type_exam_id_extension == 2) {
                if ($this->medicine_question_ex_id == 2) {
                    if ($this->type_class_id == 1) {
                        $this->questionClassessExtension = $baseQuery->whereIn('id', [5, 6])->get();
                    } else if ($this->type_class_id == 2) {
                        $this->questionClassessExtension = $baseQuery->whereIn('id', [4, 5, 6])->get();
                    } else if ($this->type_class_id == 3) {
                        $this->questionClassessExtension = $baseQuery->whereIn('id', [6])->get();
                    }
                }
            }
        } else if ($this->type_exam_id == 1 && $this->medicine_question_id == 2) {
            if ($type_exam_id_extension == 1) {
                if ($this->medicine_question_ex_id == 1) {
                    if ($this->type_class_id == 4) {
                        $this->questionClassessExtension = $baseQuery->get();
                    } else if ($this->type_class_id == 5) {
                        $this->questionClassessExtension = $baseQuery->whereIn('id', [2, 3])->get();
                    } else if ($this->type_class_id == 6) {
                        $this->questionClassessExtension = $baseQuery->whereIn('id', [3])->get();
                    }
                }
            } else if ($type_exam_id_extension == 2) {
                if ($this->medicine_question_ex_id == 2) {
                    if ($this->type_class_id == 4) {
                        $this->questionClassessExtension = $baseQuery->whereIn('id', [5, 6])->get();
                    } else if ($this->type_class_id == 5) {
                        $this->questionClassessExtension = $baseQuery->whereIn('id', [5, 6])->get();
                    } else if ($this->type_class_id == 6) {
                        $this->questionClassessExtension = $baseQuery->whereIn('id', [6])->get();
                    }
                }
            }
        } else if ($this->type_exam_id == 2) {
            if ($type_exam_id_extension == 1) {
                if ($this->medicine_question_ex_id == 1) {
                    if ($this->type_class_id == 4) {
                        $this->questionClassessExtension = $baseQuery->get();
                    } else if ($this->type_class_id == 5) {
                        $this->questionClassessExtension = $baseQuery->whereIn('id', [2, 3])->get();
                    } else if ($this->type_class_id == 6) {
                        $this->questionClassessExtension = $baseQuery->whereIn('id', [3])->get();
                    }
                }
            } else if ($type_exam_id_extension == 2) {
                if ($this->medicine_question_ex_id == 2) {
                    if ($this->type_class_id == 4) {
                        $this->questionClassessExtension = $baseQuery->whereIn('id', [4, 5, 6])->get();
                    } else if ($this->type_class_id == 5) {
                        $this->questionClassessExtension = $baseQuery->whereIn('id', [5, 6])->get();
                    } else if ($this->type_class_id == 6) {
                        $this->questionClassessExtension = $baseQuery->whereIn('id', [6])->get();
                    }
                }
            }
        }
        // TODO REFACTORIZACION DE CODIGO, AUN EN PRUEBAS PARA EVITAR IF ANIDADOS
        //     $conditions = [
        //         1 => [
        //             1 => [
        //                 1 => [1, 2, 3],
        //                 2 => [2, 3],
        //                 3 => [3]
        //             ],
        //             2 => [
        //                 1 => [5, 6],
        //                 2 => [4, 5, 6],
        //                 3 => [6]
        //             ]
        //         ],
        //         2 => [
        //             1 => [
        //                 4 => [1, 2, 3],
        //                 5 => [2, 3],
        //                 6 => [3]
        //             ],
        //             2 => [
        //                 4 => [4, 5, 6],
        //                 5 => [5, 6],
        //                 6 => [6]
        //             ]
        //         ]
        //     ];

        //     if (isset($conditions[$this->type_exam_id])
        //     && isset($conditions[$this->type_exam_id][$this->medicine_question_id])
        //     && isset($conditions[$this->type_exam_id][$this->medicine_question_id][$this->medicine_question_ex_id])
        //     && isset($conditions[$this->type_exam_id][$this->medicine_question_id][$this->medicine_question_ex_id][$this->type_class_id])) {

        //     // Obtener el resultado según las condiciones
        //    $result = $conditions[$this->type_exam_id][$this->medicine_question_id][$this->medicine_question_ex_id][$this->type_class_id];

        //     // Consultar la base de datos
        //     $this->questionClassessExtension = $baseQuery->whereIn('id', $result)->get();
        // } else {
        //     // Manejar el caso en el que alguna de las claves no existe en el array
        //     // Puedes lanzar una excepción o realizar alguna otra acción adecuada
        //     // Aquí, simplemente se imprimiría un mensaje de error:
        //     dd("Alguna clave no existe en el array de condiciones.");
        // }
        // $typeClassMappings = [
        //     1 => [
        //         1 => [
        //             1 => [
        //                 1 => [
        //                     1 => [1, 2, 3],
        //                     2 => [2, 3],
        //                     3 => [3]
        //                 ],
        //                 2 => [
        //                     1 => [5, 6],
        //                     2 => [4, 5, 6],
        //                     3 => [6]
        //                 ],
        //             ],
        //         ],
        //         2 => [
        //             1 => [
        //                 1 => [
        //                     4 => [1, 2, 3],
        //                     5 => [2, 3],
        //                     6 => [3]
        //                 ],
        //             ],
        //             2 => [
        //                 2 => [
        //                     4 => [5, 6],
        //                     5 => [5, 6],
        //                     6 => [6]
        //                 ]
        //             ]
        //         ]
        //     ],
        //     2 => [ // Nueva sección para $this->type_exam_id == 2
        //         1 => [ // Nueva sección para $type_exam_id_extension == 1
        //             1 => [ // Nueva sección para $this->medicine_question_ex_id == 1
        //                 4 => [1, 2, 3],
        //                 5 => [2, 3],
        //                 6 => [3]
        //             ],
        //         ],
        //         2 => [
        //             2 => [ // Nueva sección para $this->medicine_question_ex_id == 2
        //                 4 => [4, 5, 6],
        //                 5 => [5, 6],
        //                 6 => [6]
        //             ],
        //         ]
        //     ]
        // ];
        // function flattenArray($array)
        // {
        //     $result = [];
        //     foreach ($array as $value) {
        //         if (is_array($value)) {
        //             $result = array_merge($result, flattenArray($value));
        //         } else {
        //             $result[] = $value;
        //         }
        //     }
        //     return $result;
        // }
        // dd($classIds = $typeClassMappings[$this->type_exam_id][$this->medicine_question_id][$this->medicine_question_ex_id] ?? []);
        // dd($flattenedClassIds = flattenArray($classIds));

        // $baseQuery = TypeClass::where('medicine_question_id', $type_exam_id_extension);
        // $this->questionClassessExtension = $baseQuery->whereIn('id', $flattenedClassIds)->get();
    }
    public function updatedTypeExamIdExtension($type_exam_id_extension)
    {
        if ($type_exam_id_extension == 2) {
            $typeClassIds = [
                4 => [4, 5, 6],
                5 => [5, 6],
                6 => [6],
            ];
            if (array_key_exists($this->type_class_id, $typeClassIds)) {
                $baseQuery = TypeClass::where('medicine_question_id', $type_exam_id_extension);
                $this->questionClassessExtension = $baseQuery->whereIn('id', $typeClassIds[$this->type_class_id])->get();
            }
        }
    }
    public function updatedTypeClassId($type_class_id)
    {
        $this->typeClassId = $type_class_id;
        $this->selectedTypeClassIds;
        $this->clasificationClass = ClasificationClass::where('type_class_id', $type_class_id)->get();
    }
    public function updatedClasificationClassId($selectedClasificationClassId)
    {
        $this->selectedTypeClassIds = $selectedClasificationClassId;
    }
    public function updatedTypeClassExtensionId()
    {
        if ($this->type_class_extension_id) {
            $selectedTypeClassId = $this->selectedTypeClassIds;
            $this->clasificationClassExtension = ClasificationClass::where('type_class_id', $this->type_class_extension_id)
                ->whereNotIn('id', is_array($selectedTypeClassId) ? $selectedTypeClassId : [$selectedTypeClassId])
                ->get();
        }
    }
    public function resetClasificationClass()
    {
        $this->reset(['type_class_id', 'clasification_class_id', 'extensionClassId', 'type_exam_id_extension']);
    }
    public function resetQuestionExtension()
    {
        $this->type_exam_id_extension = [];
    }
    public function resetQuestionSelectionExtension()
    {
        $this->reset(['medicine_question_ex_id', 'extensionClassId', 'type_exam_id_extension', 'clas_class_extension_id', 'clasification_class_id']);
    }
    public function resetClasificationExtension()
    {
        $this->type_class_extension_id = [];
        $this->clas_class_extension_id = [];
    }
    public function resetClassQuestion()
    {
        $this->reset(['type_class_extension_id', 'clas_class_extension_id', 'headquarter_id', 'dateReserve', 'medicine_schedule_id']);
    }
    public function resetClassExtensionId()
    {
        $this->reset(['medicine_question_ex_id', 'type_class_extension_id', 'clas_class_extension_id', 'headquarter_id', 'dateReserve', 'medicine_schedule_id']);
    }
    // TODO AQUI TERMINA LA REFACTORIZACIÓN
    public function resetQuestions()
    {
        $this->medicine_question_id = [];
        $this->headquarter_id = '';
        $this->clasificationClass = [];
        $this->reset([
            'medicine_question_id',
            'type_class_id',
            'medicine_question_id',
            'headquarter_id',
            'dateReserve',
            'medicine_schedule_id',
            'type_exam_revaloration_id',
            'document_authorization',
            'type_exam_id_extension',
            'clasification_class_id',
            'type_class_extension_id',
            'clas_class_extension_id',
            'extensionClassId',
            'medicine_question_ex_id'
        ]);
    }
    public function openModal()
    {
        $this->confirmModal = true;
    }
    public function updatedHeadquarterId($value)
    {
        $this->scheduleMedicines = MedicineSchedule::with('scheduleHeadquarter')
            ->whereHas('scheduleHeadquarter', function ($max) use ($value) {
                $max->where('id', $value);
            })->where('status', 0)->get();
        $this->searchDisabledDays();
        $this->dateReserve = '';
    }
    public function searchDisabledDays()
    {
        $value = $this->headquarter_id;
        $disabledDays = MedicineDisabledDays::where('headquarter_id', $value)
            ->pluck('disabled_days')
            ->toArray();
        $occupiedDays = MedicineReserve::where('headquarter_id', $value)
            ->whereIn('status', [0, 1, 2, 3, 4, 10])
            ->pluck('dateReserve')
            ->toArray();
        $disabledDaysArray = [];
        foreach ($disabledDays as $days) {
            $daysArray = array_map('trim', explode(',', $days));
            $disabledDaysArray = array_merge($disabledDaysArray, $daysArray);
        }
        if ($this->headquarter_id !== null) {
            $maxCitas = MedicineSchedule::with('scheduleHeadquarter')
                ->whereHas('scheduleHeadquarter', function ($max) {
                    $max->where('id', $this->headquarter_id);
                })
                ->value('max_schedules');
            if ($this->type_exam_id == $this->type_exam_id) {
                $maxCitasException = MedicineScheduleException::with('medicineSchedules.scheduleHeadquarter', 'medicineScheduleMaxException')
                    ->whereHas('medicineSchedules.scheduleHeadquarter', function ($qException) {
                        $qException->where('id', $this->headquarter_id);
                    })
                    ->whereHas('medicineScheduleMaxException')
                    ->where('type_exam_id', $this->type_exam_id)->get();
                $maxSchedulesExceptionValue = $maxCitasException[0]->medicineScheduleMaxException->max_schedules_exception ?? null;
                if ($maxSchedulesExceptionValue !== null) {
                    $maxCitas = $maxCitas + $maxSchedulesExceptionValue;
                }
            }
            // dd($maxCitas);
            $datesExceedingLimit = MedicineReserve::select('dateReserve')
                ->where('headquarter_id', $this->headquarter_id)
                ->whereIn('status', [0, 1, 4, 10])
                ->groupBy('dateReserve')
                ->havingRaw('COUNT(*) >= ?', [$maxCitas])
                ->pluck('dateReserve')
                ->toArray();
            $datesExceedingLimit;
            $occupiedDays = array_filter($occupiedDays, function ($day) use ($datesExceedingLimit) {
                return in_array($day, $datesExceedingLimit);
            });
            $occupiedDays;
            $disabledDaysArray = array_merge($disabledDaysArray, $occupiedDays);
        }

        $this->disabledDaysFilter = $disabledDaysArray;
        // TODO TEMPORALY ONLY APPOINTMENT JANUARY
        // if ($this->idAppointmentFull === 0) {
        //     $dateMin = Carbon::create(2024, 1, 1)->format('Y-m-d');
        //     $dateMax = Carbon::create(2024, 1, 31)->format('Y-m-d');
        // } elseif ($this->idAppointmentFull === 1) {
        //     $dateMin = Carbon::now()->format('Y-m-d');
        //     $dateMax = Carbon::create(2024, 12, 31)->format('Y-m-d');
        // }
        $this->dispatchBrowserEvent('headquartersUpdated', [
            'disabledDaysFilter' => $disabledDaysArray
            // 'dateMin' => $dateMin,
            // 'dateMax' => $dateMax
        ]);
    }
    public function openModalPdf()
    {
        $this->confirmModal = false;
        $this->modal = true;
    }
    public function downloadpdf()
    {
        return response()->download(public_path('documents/Formatos_Cita_medica.pdf'));
    }
    public function save()
    {
        $this->validate();
        try {
            if (is_array($this->clasification_class_id) && empty(array_filter($this->clasification_class_id))) {
                throw new \Exception();
            }
            $citas = MedicineReserve::where('headquarter_id', $this->headquarter_id)
                ->where('dateReserve', $this->dateReserve)
                ->where(function ($query) {
                    $query->where('status', 0)
                        ->orWhere('status', 1)
                        ->orWhere('status', 4);
                })
                ->count();
            // dd($citas);
            // TODO ABRE ALGOTIRMO QUE FUNCIONA CON SWITCH CASE
            // switch ($this->to_user_headquarters) {
            //     case 7: // CIUDAD DE MEXICO
            //         $maxCitas = 50;
            //         break;
            //     case 2: // CANCUN
            //     case 3: // TIJUANA
            //     case 4: // TOLUCA
            //     case 5: // MONTERREY
            //     case 518: //MAZATLAN SINALOA
            //     case 519: //CHIAPAS
            //     case 520: //VERACRUZ
            //     case 521: //HERMOSILLO SONORA
            //         $maxCitas = 10;
            //         break;
            //     case 522: //QUERETARO
            //         $maxCitas = 10;
            //         break;
            //     case 7958: //SINALOA CULIACAN
            //         $maxCitas = 10;
            //         break;
            //     case 6: // GUADALAJARA
            //         $maxCitas = 20;
            //         break;
            //     case 523: // YUCATAN
            //         $maxCitas = 5;
            //         break;
            //     default:
            //         $maxCitas = 0;
            //         break;
            // }
            // TODO CIERRA ALGORITMO QUE FUNCIONA CON SWITCH CASE
            // $schedule = MedicineSchedule::find($this->medicine_schedule_id);
            //agendar cita normal

            $this->userid = ($this->registeredUserId != null  ? $this->registeredUserId : Auth::user()->id);
            // dd($this->userid);
            $userMedicines = MedicineReserve::with(['medicineReserveMedicine'])
                ->whereHas('medicineReserveMedicine', function ($q1) {
                    $q1->where('user_id', $this->userid);
                    $q1->where('type_exam_id', $this->type_exam_id);
                })
                ->where(function ($q) {
                    $q->where(function ($q2) {
                        $q2->whereHas('medicineReserveMedicine.medicineInitial', function ($q3) {
                            $q3->where('type_class_id', $this->type_class_id);
                        });
                    })
                        ->orWhere(function ($q2) {
                            $q2->whereHas('medicineReserveMedicine.medicineRenovation', function ($q3) {
                                $q3->where('type_class_id', $this->type_class_id);
                            });
                        });
                    // ->orWhere(function ($q2) {
                    //     $q2->whereHas('medicineReserveMedicine.medicineRevaluation', function ($q3) {
                    //         $q3->whereHas('revaluationMedicineInitial', function ($q4) {
                    //             $q4->where('type_class_id', $this->type_class_id);
                    //         });
                    //     });
                    // })
                    // ->orWhere(function ($q2) {
                    //     $q2->whereHas('medicineReserveMedicine.medicineRevaluation', function ($q3) {
                    //         $q3->whereHas('revaluationMedicineRenovation', function ($q4) {
                    //             $q4->where('type_class_id', $this->type_class_id);
                    //         });
                    //     });
                    // });
                })
                ->where(function ($queryStop) {
                    // $queryStop->where('status', 0)
                    //     ->orWhere('status', 4);
                    $queryStop->whereIn('status', [0, 4, 9]);
                })
                ->get();
            foreach ($userMedicines as $userMedicine) {
                if ($userMedicine->id) {
                    if ($userMedicine->status == 9) {
                        $message = !$this->idTypeAppointment ? 'NO ERES APTO PARA AGENDAR EN ESTA CLASE, CONSIDERA HACER REVALORACIÓN' : 'HAS SIDO NO APTO PARA ESTA CLASE POR PARTE DE LA AUTORIDAD, CONSIDERA REALIZAR UNA REVALORACIÓN';
                        throw new \Exception($message);
                        return;
                    }
                    if ($userMedicine->medicineReserveMedicine->medicineInitial->count() > 0 && $userMedicine->medicineReserveMedicine->medicineInitial[0]->type_class_id == $this->type_class_id) {
                        $this->notification([
                            'title'       => 'CITA NO GENERADA!',
                            'description' => 'YA TIENES UNA CITA AGENDADA PARA EXAMEN INICIAL' . ' ' . $userMedicine->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name,
                            'icon'        => 'error',
                            'timeout' => '3100'
                        ]);
                        return;
                    } else if ($userMedicine->medicineReserveMedicine->medicineRenovation->count() > 0 && $userMedicine->medicineReserveMedicine->medicineRenovation[0]->type_class_id == $this->type_class_id) {
                        $this->notification([
                            'title'       => 'CITA NO GENERADA!',
                            'description' => 'YA TIENES UNA CITA AGENDADA PARA EXAMEN DE RENOVACIÓN' . ' ' . $userMedicine->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name,
                            'icon'        => 'error',
                            'timeout' => '2500'
                        ]);
                        return;
                    } else if ($userMedicine->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial->count() > 0 && $userMedicine->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->type_class_id == $this->type_class_id) {
                        $this->notification([
                            'title'       => 'ERROR DE CITA!',
                            'description' => 'YA TIENES UNA CITA AGENDADA PARA EXAMEN DE REVALORACÍÓN INICIAL' . ' ' . $userMedicine->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->revaluationInitialTypeClass->name,
                            'icon'        => 'error',
                            'timeout' => '2500'
                        ]);
                        return;
                    } else if ($userMedicine->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineRenovation->count() > 0 && $userMedicine->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineRenovation[0]->type_class_id == $this->type_class_id) {
                        $this->notification([
                            'title'       => 'ERROR DE CITA!',
                            'description' => 'YA TIENES UNA CITA AGENDADA PARA EXAMEN DE REVALORACÍÓN RENOVACIÓN' . ' ' . $userMedicine->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineRenovation[0]->revaluationRenovationTypeClass->name,
                            'icon'        => 'error',
                            'timeout' => '2500'
                        ]);
                    }
                    return;
                }
            }
            // $maxCitasHorario = $schedule->max_schedules;
            //  if ($citas >= $maxCitas || $citas >= $maxCitasHorario) ALFORITMO QUE SEPARA CITAS POR HORAS
            // $maxCitas = MedicineSchedule::where('user_id', $this->to_user_headquarters)->value('max_schedules');
            $maxCitas = MedicineSchedule::with('scheduleHeadquarter')
                ->whereHas('scheduleHeadquarter', function ($max) {
                    $max->where('id', $this->headquarter_id);
                })->value('max_schedules');
            if ($this->type_exam_id == $this->type_exam_id) {
                $maxCitasException = MedicineScheduleException::with('medicineSchedules.scheduleHeadquarter', 'medicineScheduleMaxException')
                    ->whereHas('medicineSchedules.scheduleHeadquarter', function ($qException) {
                        $qException->where('id', $this->headquarter_id);
                    })
                    ->whereHas('medicineScheduleMaxException')
                    ->where('type_exam_id', $this->type_exam_id)->get();
                $maxSchedulesExceptionValue = $maxCitasException[0]->medicineScheduleMaxException->max_schedules_exception ?? null;
                if ($maxSchedulesExceptionValue !== null) {
                    $maxCitas = $maxCitas + $maxSchedulesExceptionValue;
                }
            }
            if ($citas >= $maxCitas) {
                $this->notification([
                    'title'       => 'CITA NO GENERADA!',
                    'description' => 'No hay citas disponibles para ese dia',
                    'icon'        => 'error'
                ]);
            } else {
                if (!$this->idTypeAppointment) {
                    if (empty($this->document_pay && $this->reference_number && $this->pay_date)) {
                        $saveDocument = Document::create([
                            'name_document' => 'JANUARY-APPOINTMENT',
                        ]);
                    } else {
                        $extension = $this->document_pay->getClientOriginalExtension();
                        $fileName = $this->reference_number . '-' . $this->pay_date . '.' . $extension;
                        $saveDocument = Document::create([
                            'name_document' => $this->document_pay->storeAs('documentos/medicina', $fileName, 'public'),
                        ]);
                    }
                }
                $this->saveMedicine = Medicine::create([
                    'user_id' => $this->userid,
                    'reference_number' => $this->reference_number ?? 'NO APLICA',
                    'pay_date' => $this->pay_date ?? null,
                    'document_id' => $saveDocument->id ?? null,
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
                    // foreach ($this->clasification_class_id as $clasifications) {
                    //TODO REVISAR FOREACH
                    MedicineRenovation::create([
                        'medicine_id' => $this->saveMedicine->id,
                        'type_class_id' => $this->type_class_id,
                        'clasification_class_id' => $this->clasification_class_id
                    ]);
                    // }
                } else if ($this->type_exam_id == 4) {
                    // foreach ($this->clasification_class_id as $clasifications) {
                    MedicineRenovation::create([
                        'medicine_id' => $this->saveMedicine->id,
                        'type_class_id' => $this->type_class_id,
                        'clasification_class_id' => $this->clasification_class_id
                    ]);
                    // }
                } else if ($this->type_exam_id == 3 || $this->type_exam_id == 5) {
                    // TODO SE NECESITA REVISAR EL CODIGO
                    // REGLAS FLEXIBILIDAD Y REVALORACIÓN
                    // $extension = $this->document_pay->getClientOriginalExtension();
                    // $fileName = $this->reference_number . '-' . $this->pay_date . '.' . $extension;
                    // $saveDocumentRevaloration = Document::create([
                    //     'name_document' => $this->document_authorization->storeAs('documentos/medicina', $fileName, 'public'),
                    // ]);
                    if (empty($this->document_pay && $this->reference_number && $this->pay_date)) {
                        $saveDocumentRevaloration = Document::create([
                            'name_document' => 'JANUARY-APPOINTMENT',
                        ]);
                    } else {
                        $extension = $this->document_pay->getClientOriginalExtension();
                        $fileName = $this->reference_number . '-' . $this->pay_date . '.' . $extension;
                        $saveDocumentRevaloration = Document::create([
                            'name_document' => $this->document_pay->storeAs('documentos/medicina', $fileName, 'public'),
                        ]);
                    }
                    if ($this->type_exam_id == 5) {
                        $this->type_exam_revaloration_id = 2;
                    }
                    $medicineReId = MedicineRevaluation::create([
                        'medicine_id' => $this->saveMedicine->id,
                        'document_revaloration_id' => $saveDocumentRevaloration->id,
                        'type_exam_id' => $this->type_exam_revaloration_id
                    ]);
                    if ($this->type_exam_revaloration_id == 1) {
                        // $clasification_class_ids = $this->clasification_class_id;
                        // if (is_array($clasification_class_ids)) {
                        //     foreach ($clasification_class_ids as $clasifications) {
                        //         MedicineRevaluationInitial::create([
                        //             'medicine_revaluation_id' => $medicineReId->id,
                        //             'medicine_question_id' => $this->medicine_question_id,
                        //             'type_class_id' => $this->type_class_id,
                        //             'clasification_class_id' => $clasifications
                        //         ]);
                        //     }
                        // } else
                        // {
                        MedicineRevaluationInitial::create([
                            'medicine_revaluation_id' => $medicineReId->id,
                            'medicine_question_id' => $this->medicine_question_id,
                            'type_class_id' => $this->type_class_id,
                            'clasification_class_id' => $this->clasification_class_id
                        ]);
                        // }
                    } else if ($this->type_exam_revaloration_id == 2) {
                        // foreach ($this->clasification_class_id as $clasifications) {
                        MedicineRevaluationRenovation::create([
                            'medicine_revaluation_id' => $medicineReId->id,
                            'type_class_id' => $this->type_class_id,
                            'clasification_class_id' => $this->clasification_class_id
                        ]);
                        // }
                    }
                } else if ($this->type_exam_id == 3 || $this->type_exam_id == 5) {
                    // $extension = $this->document_authorization->extension();
                    //condicion para tomar revalroción cuando es flexibilidad
                    $extension = $this->document_pay->getClientOriginalExtension();
                    $fileName = $this->reference_number . '-' . $this->pay_date . '.' . $extension;
                    $saveDocumentRevaloration = Document::create([
                        'name_document' => $this->document_authorization->storeAs('documentos/medicina', $fileName, 'public'),
                    ]);

                    $medicineReId = MedicineRevaluation::create([
                        'medicine_id' => $this->saveMedicine->id,
                        'document_revaloration_id' => $saveDocumentRevaloration->id,
                        'type_exam_id' => $this->type_exam_revaloration_id
                    ]);
                    if ($this->type_exam_revaloration_id == 1) {
                        $clasification_class_ids = $this->clasification_class_id;
                        if (is_array($clasification_class_ids)) {
                            foreach ($clasification_class_ids as $clasifications) {
                                MedicineRevaluationInitial::create([
                                    'medicine_revaluation_id' => $medicineReId->id,
                                    'medicine_question_id' => $this->medicine_question_id,
                                    'type_class_id' => $this->type_class_id,
                                    'clasification_class_id' => $clasifications
                                ]);
                            }
                        } else {
                            MedicineRevaluationInitial::create([
                                'medicine_revaluation_id' => $medicineReId->id,
                                'medicine_question_id' => $this->medicine_question_id,
                                'type_class_id' => $this->type_class_id,
                                'clasification_class_id' => $clasification_class_ids
                            ]);
                        }
                    } else if ($this->type_exam_revaloration_id == 2) {
                        foreach ($this->clasification_class_id as $clasifications) {
                            MedicineRevaluationRenovation::create([
                                'medicine_revaluation_id' => $medicineReId->id,
                                'type_class_id' => $this->type_class_id,
                                'clasification_class_id' => $clasifications
                            ]);
                        }
                    }
                }
                // dd($this->userid);
                $cita = new MedicineReserve();

                $cita->from_user_appointment = $this->userid;
                $cita->medicine_id = $this->saveMedicine->id;
                $cita->headquarter_id = $this->headquarter_id;
                $cita->dateReserve = $this->dateReserve;
                $cita->medicine_schedule_id = $this->medicine_schedule_id;
                $cita->is_external = $this->idTypeAppointment;
                $cita->save();

                $this->saveMedicineid = $cita->id;

                if ($this->extensionClassId == 1) {
                    $citaExtension = new MedicineReservesExtension();
                    $citaExtension->medicine_reserve_id = $cita->id;
                    $citaExtension->type_class_extension_id = $this->type_class_extension_id;
                    $citaExtension->clas_class_extension_id = $this->clas_class_extension_id;
                    $citaExtension->save();
                }

                $this->DataMedReservations();
                session(['saved_medicine_id' => $this->saveMedicine->id]);
                $this->generatePdf();
                $this->clean();
                $this->openConfirm();
            }
        } catch (\Exception $e) {
            $this->dialog([
                'title' => '¡ATENCIÓN!',
                'description' => $e->getMessage(),
                'icon' => 'info'
            ]);
        }
    }

    public function DataMedReservations()
    {

        $reference_number = $this->reference_number ?? 'NO APLICA-' . $this->saveMedicine->id;
        $is_studying =  ($this->medicine_question_id == 1) ? 1 : 0;
        $has_extension = ($this->extensionClassId) ? 1 : 0;

        $typeClass = ($this->type_class_id <= 3) ? $this->type_class_id : ['4' => 1, '5' => 2, '6' => 3][$this->type_class_id];
        $type_class_extension_id = ($this->type_class_extension_id <= 3) ? $this->type_class_extension_id : ['4' => 1, '5' => 2, '6' => 3][$this->type_class_extension_id];
        $medicine_question_ex_id = $this->medicine_question_ex_id ?? 0;

        if ($has_extension == 1) {
            $citas =
                [
                    'id' => $this->saveMedicineid,
                    'user_id' => $this->userid,
                    'license_reason_id' => $this->type_exam_id,
                    'type_class_id' => $typeClass,
                    'license_class_id' => $this->clasification_class_id,
                    'headquarter_id' => $this->headquarter_id,
                    'reference_number' => $reference_number,
                    'pay_date' => $this->pay_date,
                    'reserve_date' => $this->dateReserve,
                    'is_studying' => $is_studying,
                    'has_extension' => $has_extension,
                    'license_reval_id' => $this->type_exam_revaloration_id,
                    'type_exam_id_extension' => $this->type_exam_id_extension,
                    'type_class_extension_id' => $type_class_extension_id,
                    'clas_class_extension_id' => $this->clas_class_extension_id,
                    'medicine_question_ex_id' => $medicine_question_ex_id
                ];
        } else {
            $citas =
                [
                    'id' => $this->saveMedicineid,
                    'user_id' => $this->userid,
                    'license_reason_id' => $this->type_exam_id,
                    'type_class_id' => $typeClass,
                    'license_class_id' => $this->clasification_class_id,
                    'headquarter_id' => $this->headquarter_id,
                    'reference_number' => $reference_number,
                    'pay_date' => $this->pay_date,
                    'reserve_date' => $this->dateReserve,
                    'is_studying' => $is_studying,
                    'has_extension' => $has_extension,
                    'license_reval_id' => $this->type_exam_revaloration_id
                ];
        }

        if (checkdnsrr('crp.sct.gob.mx', 'A')) {
            $response = Http::withHeaders([
                'Accept' => 'application/json'
            ])->connectTimeout(30)->post('https://siafac.afac.gob.mx/createCita?', $citas);
            // ])->connectTimeout(30)->post('http://afac-tenant.gob/createCita?', $citas);
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
            $this->LogsApi($curp_logs = Auth::user()->UserParticipant->first()->curp, $type = 'AGENDAR CITA', $register = 'SIN CONEXION', $description = 'No hay conexión, vuelve a intentarlo');
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
    public function cleanclass()
    {
        $this->reset([
            'clasification_class_id',
        ]);
    }
    public function openConfirm()
    {
        $this->idAppointmentFull;
        $this->medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'medicineReserveHeadquarter', 'reserveSchedule', 'medicineReserveMedicineExtension'])
            ->where('medicine_id', $this->saveMedicine->id)->get();
        $dateConverted = $this->medicineReserves[0]->dateReserve;
        $this->dateConvertedFormatted = Date::parse($dateConverted)->format('l j F Y');
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
        $savedMedicineId = session('saved_medicine_id');
        Medicine::find($savedMedicineId);
        $this->id_medicineReserve = $idUpdate;
        $this->idMedicine = $savedMedicineId;
        $this->deleteRelationShip();
    }
    public function confirmDelete()
    {
        $updateReserve = MedicineReserve::find($this->id_medicineReserve);
        $updateReserve->update([
            'status' => 3
        ]);
        $updateReservePay = Medicine::find($this->idMedicine);
        $updateReservePay->update([
            'reference_number' => "CANCELADO" . '-' . $this->idMedicine
        ]);
        $this->notification([
            'title'       => 'CITA CANCELADA ÉXITOSAMENTE',
            'icon'        => 'error',
            'timeout' => '3100'
        ]);

        $this->confirmDeleteApi();
    }

    public function confirmDeleteApi()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->connectTimeout(30)->put('https://siafac.afac.gob.mx/statusCita?',
        [
            'id' => $this->id_medicineReserve,
            'status_id' => 8,
            'cancelActive' => 'CANCEL'
        ]);
        if ($response->successful()) {
            $statesSuccess = $response->json()['data'];
        }
    }

    public function generatePdf()
    {
        $savedMedicineId = session('saved_medicine_id');
        $idExternalInternal = session('idType'); //TODO
        $medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'medicineReserveHeadquarter', 'medicineReserveMedicineExtension'])
            ->where('medicine_id', $savedMedicineId)->get();
        $medicineId = $medicineReserves[0]->id;
        $dateAppointment = $medicineReserves[0]->dateReserve;
        $dateConvertedFormatted = Date::parse($dateAppointment)->format('l j F Y');
        $curp = $medicineReserves[0]->medicineReserveMedicine->medicineUser->userParticipant->pluck('curp')->first();
        $keyEncrypts =  Crypt::encryptString($medicineId . '*' . $dateAppointment . '*' . $curp);

        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($keyEncrypts)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->validateResult(false)
            ->build();
        $keyEncrypt = $result->getDataUri();


        if (!$idExternalInternal) {
            $fileName = $medicineReserves[0]->dateReserve . '-' . $curp . '-' . 'MED-' . $medicineId . '.pdf';
        } else {
            $fileName = $medicineReserves[0]->dateReserve . '-' . $curp . '-' . 'MED-EXT-' . $medicineId . '.pdf';
        }
        $thirdAppointment = MedicineReserve::where('headquarter_id', $medicineReserves[0]->headquarter_id)
            ->where('dateReserve', $medicineReserves[0]->dateReserve)
            ->where(function ($query) {
                $query->where('status', 0)
                    ->Orwhere('status', 1);
            })
            ->where(function ($query2) {
                $query2->where('is_external', true);
            })
            ->count();
        if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 1) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-initial', compact('medicineReserves', 'keyEncrypt', 'dateConvertedFormatted', 'idExternalInternal', 'thirdAppointment'));
            return $pdf->download($fileName);
        } else if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 2) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-renovation', compact('medicineReserves', 'keyEncrypt', 'dateConvertedFormatted', 'idExternalInternal', 'thirdAppointment'));
            return $pdf->download($fileName);
        } else if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 3) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-revaluation', compact('medicineReserves', 'keyEncrypt', 'dateConvertedFormatted'));
            return $pdf->download($fileName);
        } else if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 4) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-revaluation-accident', compact('medicineReserves', 'keyEncrypt', 'dateConvertedFormatted'));
            return $pdf->download($fileName);
        } else if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 5) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-flexibility', compact('medicineReserves', 'keyEncrypt', 'dateConvertedFormatted'));
            return $pdf->download($fileName);
        }
    }
    public function returnDashboard()
    {
        session()->forget('idType');
        return redirect()->route('afac.home');
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
            'document_pay.required' => 'Documento obligatorio.',
            'document_pay.mimetypes' => 'Solo documentos .PDF.',
            'document_pay.max' => 'No permitido, tamaño maximo 500 KB',
            'document_authorization.required' => 'Documento obligatorio.',
            'document_authorization.mimetypes' => 'Solo documentos .PDF.',
            'document_authorization.max' => 'No permitido, tamaño maximo 500 KB',
        ];
    }
}
