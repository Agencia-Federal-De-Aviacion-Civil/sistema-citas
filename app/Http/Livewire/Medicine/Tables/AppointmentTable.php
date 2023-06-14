<?php

namespace App\Http\Livewire\Medicine\Tables;

use App\Events\Medicine\ExportCompleted;
use App\Jobs\ExportSelectedJob;
use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\MedicineReserve;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use WireUi\Traits\Actions;

class AppointmentTable extends DataTableComponent
{
    use Actions;
    public $batchId;
    public $exporting;
    public $exportFinished;
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'cancelReserve' => '$refresh',
                'attendeReserve' => '$refresh',
                'reserveAppointment' => '$refresh',
            ]
        );
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setBulkActions([
            'exportSelected' => 'EXPORTAR'
        ]);
        $this->setPerPageAccepted([
            10, 20, 50, 100
        ]);
        $this->setOfflineIndicatorEnabled();
        $this->setEagerLoadAllRelationsEnabled();
    }
    public function columns(): array
    {
        return [

            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "medicineReserveFromUser.name")
                ->sortable()
                ->searchable(fn ($query, $searchTerm) => $query->orWhere('users.name', 'like', '%' . $searchTerm . '%')),

            Column::make("Apellido Paterno", "userParticipantUser.apParental")
                ->sortable()
                ->searchable(fn ($query, $searchTerm) => $query->orWhere('apParental', 'like', '%' . $searchTerm . '%')),

            Column::make("Apellido Materno", "userParticipantUser.apMaternal")
                ->sortable()
                ->searchable(fn ($query, $searchTerm) => $query->orWhere('apMaternal', 'like', '%' . $searchTerm . '%')),

            Column::make("Tipo", "medicineReserveMedicine.medicineTypeExam.name")
                ->sortable(),

            Column::make("CLASE", "class")
                ->label(fn ($row) => view(
                    'afac.tables.appointmentTable.actions.type-classes',
                    [
                        $class = MedicineReserve::with([
                            'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
                        ])->where('id', $row->id)->get(),
                        'class' => $class
                    ]
                )),

            Column::make("TIPO DE LICENCIA", "licencia")
                ->label(fn ($row) => view(
                    'afac.tables.appointmentTable.actions.classification-classes',
                    [
                        $licencia = MedicineReserve::with([
                            'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
                        ])->where('id', $row->id)->get(),
                        'licencias' => $licencia
                    ]
                )),
                Column::make("SEDE", "sede")
                ->label(fn ($row) => view(
                    'afac.tables.appointmentTable.actions.sedes-filter',
                    [
                        $sede = MedicineReserve::with([
                            'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
                        ])->where('id', $row->id)->get(),
                        'sede' => $sede
                    ]
                )),
            Column::make("FECHA", "dateReserve")
                ->sortable()
                ->searchable()
                ->format(fn ($value) => Carbon::parse($value)->format('d/m/Y')),

            Column::make("HORA", "medicineSchedule.time_start")
                ->sortable(),

            Column::make("CURP", "userParticipantUser.curp")
                ->sortable()
                ->searchable(fn ($query, $searchTerm) => $query->orWhere('curp', 'like', '%' . $searchTerm . '%')),

            Column::make("LLAVE DE PAGO", "medicineReserveMedicine.reference_number")
                ->sortable()
                ->searchable(fn ($query, $searchTerm) => $query->orWhere('reference_number', 'like', '%' . $searchTerm . '%')),

            Column::make('FORMATOS')
                ->sortable()
                ->label(fn ($row) => view(
                    'afac.tables.appointmentTable.actions.download-file',
                    [
                        $medicine = MedicineReserve::with(
                            'medicineReserveMedicine'
                        )->where('id', $row->id)->get(),
                        'medicine' => $medicine,
                        'tipo' => $medicine[0]->medicineReserveMedicine->medicineTypeExam->id,
                        'id' => $medicine[0]->medicineReserveMedicine->medicineDocument->name_document
                    ]
                )),

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
                        'components.schedule-component',
                        [
                            $action = MedicineReserve::where('id', $row->id)->get(),
                            'status' => $action[0]->status,
                            'scheduleId' => $action[0]->id,
                            'medicineId' => $action[0]->medicine_id
                        ]
                    )
                ),
        ];
    }
    public function builder(): Builder
    {
        // return MedicineReserve::query()
        //     ->where('users.name', '!=', 'admin');
         if (Auth::user()->can('super_admin.medicine_admin.see.schedule.table')) {
            return MedicineReserve::query()->with([
                'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
            ]);
        } else if (Auth::user()->can('user.see.schedule.table')) {
            return MedicineReserve::query()->with([
                'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
            ])->whereHas('medicineReserveMedicine', function ($q1) {
                $q1->where('user_id', Auth::user()->id);
            });
        } else if (Auth::user()->can('headquarters.see.schedule.table')) {
            return MedicineReserve::query()->with([
                'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
            ])->where('to_user_headquarters', Auth::user()->id);
        }
    }
    public function filters(): array
    {
        return [
            SelectFilter::make('TIPO')
                ->options([
                    '' => 'TODOS',
                    '1' => 'INICIAL',
                    '2' => 'RENOVACIÓN',
                    '3' => 'REVALORACIÓN'
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
                    '2' => 'CANCUN QUINTANA ROO',
                    '3' => 'TIJUANA BC',
                    '4' => 'TOLUCA AEROPUERTO',
                    '5' => 'MONTERREY AEROPUERTO',
                    '6' => 'GUADALAJARA AEROPUERTO',
                    '7' => 'CIUDAD DE MÉXICO AEROPUERTO BJ',
                    '518' => 'MAZATLAN SINALOA',
                    '519' => 'TUXTLA GTZ. CHIAPAS',
                    '520' => 'VERACRUZ VERACRUZ',
                    '521' => 'HERMOSILLO SONORA',
                    '522' => 'QUERETARO QRO',
                    '523' => 'MERIDA YUCATAN',
                    '7958' => 'SINALOA CULIACAN'
                ])
                ->filter(function ($query, $value) {
                    $query->where('to_user_headquarters', $value);
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
        ];
    }

    public function exportSelected()
    {
        if ($this->getSelected()) {
            try {
                $query = MedicineReserve::with([
                    'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
                ])->whereIn('id', $this->getSelected());
                $results = $query->get();
                foreach ($results as $result) {
                    if (empty($result->userParticipantUser->apParental) || empty($result->userParticipantUser->apMaternal) || empty($result->userParticipantUser->genre)) {
                        $emptyFields[] = $result->id;
                    }
                }
                if (!empty($emptyFields)) {
                    $errorMessage = 'Los siguientes registros tienen campos vacíos en informacion personal del participante: ' . implode(', ', $emptyFields);
                    throw new \Exception($errorMessage);
                }
                $this->exporting = true;
                $this->exportFinished = false;
                $batch = Bus::batch([
                    new ExportSelectedJob($results),
                ])->dispatch();
                $this->batchId = $batch->id;
                $this->emit('BatchDispatch', [$this->batchId, $this->exporting, $this->exportFinished]);
            } catch (\Exception $e) {
                $this->notification([
                    'title'       => 'ERROR DE EXPORTACIÓN!',
                    'description' =>  $errorMessage = $e->getMessage(),
                    'icon'        => 'error',
                    'timeout' => '3100'
                ]);
            }
        } else {
        }
    }
}
