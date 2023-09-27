<?php

namespace App\Http\Livewire\Medicine\Tables;

use App\Jobs\ExportSelectedJob;
use App\Models\Medicine\MedicineExportHistory;
use App\Models\Medicine\MedicineReserve;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Date;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use WireUi\Traits\Actions;

use function Deployer\parse;

class AppointmentThirdTable extends DataTableComponent
{
    use Actions;
    public $batchId;
    public $exporting;
    public $exportFinished;
    public $date;
    public function configure(): void
    {
        Date::setLocale('es');
        $this->date = Carbon::now()->timezone('America/Mexico_City');

        $this->setPrimaryKey('id');
        $this->setBulkActions([
            'exportSelected' => 'EXPORTAR'
        ]);
        $this->setPerPageAccepted([
            10, 20, 50, 100
        ]);
        $this->setOfflineIndicatorEnabled();
        $this->setEagerLoadAllRelationsEnabled();
        $this->setDefaultSort('id', 'asc');
    }
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'postponeReserve' => '$refresh',
                'cancelReserve' => '$refresh',
                'attendeReserve' => '$refresh',
                'reserveAppointment' => '$refresh',
            ]
        );
    }
    public function columns(): array
    {
        if (Auth::user()->can('super_admin.medicine_admin.see.schedule.table')) {
            return [

                Column::make("Id", "id")
                    ->sortable()
                    ->searchable(fn ($query, $searchTerm) => $query->orWhere('medicine_reserves.id', 'like', '%' . $searchTerm . '%')),
                Column::make("Nombre", "medicineReserveFromUser.name")
                    ->sortable()
                    ->searchable(fn ($query, $searchTerm) => $query->orWhere('users.name', 'like', '%' . $searchTerm . '%')),
                Column::make("Apellido Paterno", "userParticipantUser.apParental")
                    ->sortable()
                    ->searchable(fn ($query, $searchTerm) => $query->orWhere('apParental', 'like', '%' . $searchTerm . '%')),
                Column::make("Apellido Materno", "userParticipantUser.apMaternal")
                    ->sortable()
                    ->searchable(fn ($query, $searchTerm) => $query->orWhere('apMaternal', 'like', '%' . $searchTerm . '%')),
                Column::make("SEDE", "medicineReserveHeadquarter.name_headquarter")
                    ->sortable(),
                Column::make("Tipo", "medicineReserveMedicine.medicineTypeExam.name")
                    ->sortable(),
                Column::make("CLASE", "class")
                    ->label(fn ($row) => view(
                        'afac.tables.appointmentTable.actions.type-classes',
                        [
                            $class = MedicineReserve::with([
                                'medicineReserveMedicine', 'medicineReserveFromUser', 'userParticipantUser',
                            ])->where('id', $row->id)->get(),
                            'class' => $class,
                        ]
                    )),

                Column::make("TIPO DE LICENCIA", "licencia")
                    ->label(fn ($row) => view(
                        'afac.tables.appointmentTable.actions.classification-classes',
                        [
                            $licencia = MedicineReserve::with([
                                'medicineReserveMedicine', 'medicineReserveFromUser', 'userParticipantUser',
                            ])->where('id', $row->id)->get(),
                            'licencias' => $licencia,
                        ]
                    )),
                Column::make("FECHA", "dateReserve")
                    ->sortable()
                    ->searchable()
                    ->format(fn ($value) => Carbon::parse($value)->format('d/m/Y')),

                Column::make("HORA", "reserveSchedule.time_start")
                    ->sortable(),

                Column::make("CURP", "userParticipantUser.curp")
                    ->sortable()
                    ->searchable(fn ($query, $searchTerm) => $query->orWhere('curp', 'like', '%' . $searchTerm . '%')),
                Column::make("GENERO", "userParticipantUser.genre")
                    ->sortable(),

                Column::make("NACIMIENTO", "userParticipantUser.birth")
                    ->sortable(),

                Column::make("NACIÓ", "userParticipantUser.participantState.name")
                    ->sortable(),

                Column::make("EDAD", "userParticipantUser.age")
                    ->sortable(),

                Column::make("CELULAR", "userParticipantUser.mobilePhone")
                    ->sortable(),

                Column::make("OFICINA", "userParticipantUser.officePhone")
                    ->sortable(),

                Column::make("EXTENSIÓN", "userParticipantUser.extension")
                    ->sortable(),

                Column::make("ACCIÓN")
                    ->label(
                        fn ($row) => view(
                            'components.medicine.appointment-actions-component',
                            [
                                $action = MedicineReserve::where('id', $row->id)->get(),
                                'status' => $action[0]->status,
                                'scheduleId' => $action[0]->id,
                                'medicineId' => $action[0]->medicine_id,
                                $wait_date = new Carbon($action[0]->dateReserve, 'America/Mexico_City'),
                                $days_wait = $this->date->diffInDays($wait_date),
                                'days' => $days_wait,
                                'wait_date' => $wait_date
                            ]
                        )
                    ),
            ];
        } else if (Auth::user()->can('user.see.schedule.table')) {
            return [

                Column::make("Id", "id")
                    ->sortable()
                    ->searchable(fn ($query, $searchTerm) => $query->orWhere('medicine_reserves.id', 'like', '%' . $searchTerm . '%')),
                Column::make("Tipo", "medicineReserveMedicine.medicineTypeExam.name")
                    ->sortable(),
                Column::make("SEDE", "medicineReserveHeadquarter.name_headquarter")
                    ->sortable(),
                Column::make("CLASE", "class")
                    ->label(fn ($row) => view(
                        'afac.tables.appointmentTable.actions.type-classes',
                        [
                            $class = MedicineReserve::with([
                                'medicineReserveMedicine', 'medicineReserveFromUser', 'userParticipantUser',
                            ])->where('id', $row->id)->get(),
                            'class' => $class,
                        ]
                    )),

                Column::make("TIPO DE LICENCIA", "licencia")
                    ->label(fn ($row) => view(
                        'afac.tables.appointmentTable.actions.classification-classes',
                        [
                            $licencia = MedicineReserve::with([
                                'medicineReserveMedicine', 'medicineReserveFromUser', 'userParticipantUser',
                            ])->where('id', $row->id)->get(),
                            'licencias' => $licencia,
                        ]
                    )),
                Column::make("FECHA", "dateReserve")
                    ->sortable()
                    ->searchable()
                    ->format(fn ($value) => Carbon::parse($value)->format('d/m/Y')),

                Column::make("HORA", "reserveSchedule.time_start")
                    ->sortable(),

                Column::make("CURP", "userParticipantUser.curp")
                    ->sortable()
                    ->searchable(fn ($query, $searchTerm) => $query->orWhere('curp', 'like', '%' . $searchTerm . '%')),
                Column::make("GENERO", "userParticipantUser.genre")
                    ->sortable(),

                Column::make("NACIMIENTO", "userParticipantUser.birth")
                    ->sortable(),

                Column::make("NACIÓ", "userParticipantUser.participantState.name")
                    ->sortable(),

                Column::make("EDAD", "userParticipantUser.age")
                    ->sortable(),

                Column::make("CELULAR", "userParticipantUser.mobilePhone")
                    ->sortable(),

                Column::make("OFICINA", "userParticipantUser.officePhone")
                    ->sortable(),

                Column::make("EXTENSIÓN", "userParticipantUser.extension")
                    ->sortable(),

                Column::make("ACCIÓN")
                    ->label(
                        fn ($row) => view(
                            'components.medicine.appointment-actions-component',
                            [
                                $action = MedicineReserve::where('id', $row->id)->get(),
                                $dateExpire = Carbon::parse($action[0]->dateReserve),
                                $showExpireButton = Auth::user()->hasRole('user') && Carbon::now()->lt($dateExpire),
                                'buttonExpire' => $showExpireButton,
                                'status' => $action[0]->status,
                                'scheduleId' => $action[0]->id,
                                'medicineId' => $action[0]->medicine_id,
                                $wait_date = new Carbon($action[0]->dateReserve, 'America/Mexico_City'),
                                $days_wait = $this->date->diffInDays($wait_date),
                                'days' => $days_wait,
                                'wait_date' => $wait_date
                            ]
                        )
                    ),
            ];
        } else if (Auth::user()->can('headquarters_authorized.see.table')) {
            return [

                Column::make("Id", "id")
                    ->sortable()
                    ->searchable(fn ($query, $searchTerm) => $query->orWhere('medicine_reserves.id', 'like', '%' . $searchTerm . '%')),
                Column::make("Nombre", "medicineReserveFromUser.name")
                    ->sortable()
                    ->searchable(fn ($query, $searchTerm) => $query->orWhere('users.name', 'like', '%' . $searchTerm . '%')),
                Column::make("Apellido Paterno", "userParticipantUser.apParental")
                    ->sortable()
                    ->searchable(fn ($query, $searchTerm) => $query->orWhere('apParental', 'like', '%' . $searchTerm . '%')),
                Column::make("Apellido Materno", "userParticipantUser.apMaternal")
                    ->sortable()
                    ->searchable(fn ($query, $searchTerm) => $query->orWhere('apMaternal', 'like', '%' . $searchTerm . '%')),
                Column::make("SEDE", "medicineReserveHeadquarter.name_headquarter")
                    ->sortable(),
                Column::make("Tipo", "medicineReserveMedicine.medicineTypeExam.name")
                    ->sortable(),
                Column::make("CLASE", "class")
                    ->label(fn ($row) => view(
                        'afac.tables.appointmentTable.actions.type-classes',
                        [
                            $class = MedicineReserve::with([
                                'medicineReserveMedicine', 'medicineReserveFromUser', 'userParticipantUser',
                            ])->where('id', $row->id)->get(),
                            'class' => $class,
                        ]
                    )),

                Column::make("TIPO DE LICENCIA", "licencia")
                    ->label(fn ($row) => view(
                        'afac.tables.appointmentTable.actions.classification-classes',
                        [
                            $licencia = MedicineReserve::with([
                                'medicineReserveMedicine', 'medicineReserveFromUser', 'userParticipantUser',
                            ])->where('id', $row->id)->get(),
                            'licencias' => $licencia,
                        ]
                    )),
                Column::make("FECHA", "dateReserve")
                    ->sortable()
                    ->searchable()
                    ->format(fn ($value) => Carbon::parse($value)->format('d/m/Y')),

                Column::make("HORA", "reserveSchedule.time_start")
                    ->sortable(),

                Column::make("CURP", "userParticipantUser.curp")
                    ->sortable()
                    ->searchable(fn ($query, $searchTerm) => $query->orWhere('curp', 'like', '%' . $searchTerm . '%')),
                Column::make("GENERO", "userParticipantUser.genre")
                    ->sortable(),

                Column::make("NACIMIENTO", "userParticipantUser.birth")
                    ->sortable(),

                Column::make("NACIÓ", "userParticipantUser.participantState.name")
                    ->sortable(),

                Column::make("EDAD", "userParticipantUser.age")
                    ->sortable(),

                Column::make("CELULAR", "userParticipantUser.mobilePhone")
                    ->sortable(),

                Column::make("OFICINA", "userParticipantUser.officePhone")
                    ->sortable(),

                Column::make("EXTENSIÓN", "userParticipantUser.extension")
                    ->sortable(),

                Column::make("ACCIÓN")
                    ->label(
                        fn ($row) => view(
                            'components.medicine.appointment-actions-component',
                            [
                                $action = MedicineReserve::where('id', $row->id)->get(),
                                'status' => $action[0]->status,
                                'scheduleId' => $action[0]->id,
                                'medicineId' => $action[0]->medicine_id,
                                $wait_date = new Carbon($action[0]->dateReserve, 'America/Mexico_City'),
                                $days_wait = $this->date->diffInDays($wait_date),
                                'days' => $days_wait,
                                'wait_date' => $wait_date,
                            ]
                        )
                    ),
            ];
        }
    }
    public function filters(): array
    {
        if (Auth::user()->can('super_admin.medicine_admin.see.schedule.table')) {
            return [
                SelectFilter::make('TIPO')
                    ->options([
                        '' => 'TODOS',
                        '1' => 'INICIAL',
                        '2' => 'RENOVACIÓN'
                    ])
                    ->filter(function ($query, $value) {
                        $query->where('type_exam_id', $value);
                    }),
                SelectFilter::make('STATUS')
                    ->options([
                        '' => 'TODOS',
                        '0' => 'PENDIENTE',
                        '1' => 'ASISTIÓ',
                        '2' => 'CANCELADO',
                        '3' => 'CANCELÓ',
                        '4' => 'REAGENDADA',
                        '5' => 'LIBERADA'

                    ])
                    ->filter(function ($query, $value) {
                        $query->where('medicine_reserves.status', $value);
                    }),

                DateFilter::make('Desde')
                    ->filter(function ($query, $value) {
                        $query->whereDate('dateReserve', '>=', $value);
                    }),

                DateFilter::make('Hasta')
                    ->filter(function ($query, $value) {
                        $query->whereDate('dateReserve', '<=', $value);
                    }),
                SelectFilter::make('SEDE')
                    ->options([
                        '' => 'TODOS',
                        '14' => 'MEA LILIA MARIBEL DEL VALLE MARTíNEZ',
                        '15' => 'MEA KATYA DEYANIRA MAGAÑA MUÑOZ',
                        '16' => 'MEA CÉSAR ULISES BLAS TORRES',
                        '17' => 'MEA JOSÉ MANUEL CÓRDOVA CERVANTES',
                        '18' => 'MEA ROSEMBERG CASTILLEJOS VARGAS'
                    ])
                    ->filter(function ($query, $value) {
                        $query->where('headquarter_id', $value);
                    }),

                SelectFilter::make('GENERO')
                    ->options([
                        '' => 'TODOS',
                        'FEMENINO' => 'FEMENINO',
                        'MASCULINO' => 'MASCULINO',
                    ])
                    ->filter(function ($query, $value) {
                        $query->where('genre', $value);
                    }),

                TextFilter::make('ID CITA')
                    ->config([
                        'placeholder' => 'Buscar cita',
                    ])
                    ->filter(function (Builder $builder, string $value) {
                        $builder->where('medicine_reserves.id', 'like', '%' . $value . '%');
                    }),
            ];
        } else if (Auth::user()->can('headquarters_authorized.see.table')) {
            return [
                SelectFilter::make('TIPO')
                    ->options([
                        '' => 'TODOS',
                        '1' => 'INICIAL',
                        '2' => 'RENOVACIÓN',
                    ])
                    ->filter(function ($query, $value) {
                        $query->where('type_exam_id', $value);
                    }),
                SelectFilter::make('STATUS')
                    ->options([
                        '' => 'TODOS',
                        '0' => 'PENDIENTE',
                        '1' => 'ASISTIÓ',
                        '2' => 'CANCELADO',
                        '3' => 'CANCELO',
                        '4' => 'REAGENDADA',
                        '5' => 'LIBERADA',
                        '6' => 'INCOMPLETAS',
                        '7' => 'EXPIRO',
                        '8' => 'CONCLUYÓ APTO',
                        '9' => 'CONCLUYÓ NO APTO',
                        '10' => 'REAGENDO'
                    ])
                    ->filter(function ($query, $value) {
                        $query->where('medicine_reserves.status', $value);
                    }),

                DateFilter::make('Desde')
                    ->filter(function ($query, $value) {
                        $query->whereDate('dateReserve', '>=', $value);
                    }),

                DateFilter::make('Hasta')
                    ->filter(function ($query, $value) {
                        $query->whereDate('dateReserve', '<=', $value);
                    }),
                SelectFilter::make('SEDE')
                    ->options([
                        '' => 'TODOS',
                    ])
                    ->filter(function ($query, $value) {
                        $query->where('headquarter_id', $value);
                    }),

                SelectFilter::make('GENERO')
                    ->options([
                        '' => 'TODOS',
                        'FEMENINO' => 'FEMENINO',
                        'MASCULINO' => 'MASCULINO',
                    ])
                    ->filter(function ($query, $value) {
                        $query->where('genre', $value);
                    }),

                TextFilter::make('ID CITA')
                    ->config([
                        'placeholder' => 'Buscar cita',
                    ])
                    ->filter(function (Builder $builder, string $value) {
                        $builder->where('medicine_reserves.id', 'like', '%' . $value . '%');
                    }),
            ];
        } else if (Auth::user()->can('user.see.schedule.table')) {
            return [];
        }
    }
    public function builder(): Builder
    {
        if (Auth::user()->can('super_admin.medicine_admin.see.schedule.table')) {
            return MedicineReserve::query()->with([
                'medicineReserveMedicine', 'medicineReserveFromUser', 'userParticipantUser',
            ])->where('medicine_reserves.is_external', true);
        } else if (Auth::user()->can('user.see.schedule.table')) {
            return MedicineReserve::query()->with([
                'medicineReserveMedicine', 'medicineReserveFromUser', 'userParticipantUser',
            ])->whereHas('medicineReserveMedicine', function ($q1) {
                $q1->where('user_id', Auth::user()->id)
                    ->where('medicine_reserves.is_external', true);
            });
        } else
        if (Auth::user()->can('headquarters_authorized.see.table')) {
            return MedicineReserve::query()->with([
                'medicineReserveMedicine', 'medicineReserveFromUser', 'userParticipantUser', 'medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant',
            ])->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                $q1->where('user_id', Auth::user()->id);
            })->where('medicine_reserves.is_external', true);
        }
    }
    public function exportSelected()
    {
        if ($this->getSelected()) {
            try {
                $query = MedicineReserve::with([
                    'medicineReserveHeadquarter:id,name_headquarter',
                    'medicineReserveMedicine:id,reference_number,type_exam_id', 'medicineReserveFromUser:id,name',
                    'medicineReserveMedicine.medicineRevaluation:id,type_exam_id',
                    'medicineReserveMedicine.medicineTypeExam:name',
                    'userParticipantUser:id,apParental,apMaternal,curp,genre,birth,age,mobilePhone,officePhone,extension',
                    'userParticipantUser.participantState:id,name', 'reserveSchedule:id,time_start'
                ])->whereIn('id', $this->getSelected());
                $results = $query->get();
                $this->exporting = true;
                $this->exportFinished = false;
                $saveExports = MedicineExportHistory::create(
                    [
                        'auth' => Auth::user()->id,
                    ]
                );
                $dataExports = $saveExports->auth . '-' . $saveExports->created_at;
                $batch = Bus::batch([
                    new ExportSelectedJob($results, $dataExports),
                ])->dispatch();
                $this->batchId = $batch->id;
                $this->emit('BatchDispatch', [$this->batchId, $this->exporting, $this->exportFinished]);
            } catch (\Exception $e) {
                $this->notification([
                    'title'       => 'ERROR DE EXPORTACIÓN!',
                    'description' =>  $e->getMessage(),
                    'icon'        => 'error',
                    'timeout' => '3100'
                ]);
            }
        } else {
        }
    }
}
