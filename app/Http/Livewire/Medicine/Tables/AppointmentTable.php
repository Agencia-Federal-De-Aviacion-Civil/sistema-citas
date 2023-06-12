<?php

namespace App\Http\Livewire\Medicine\Tables;

use App\Events\Medicine\ExportCompleted;
use App\Jobs\ExportSelectedJob;
use App\Models\Medicine\MedicineReserve;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use WireUi\Traits\Actions;

class AppointmentTable extends DataTableComponent
{

    use Actions;

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
                    'livewire.medicine.tables.actions.type-classe',
                    [
                        $class = MedicineReserve::with([
                            'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
                        ])->where('id', $row->id)->get(),
                        'class' => $class
                    ]
                )),

            Column::make("TIPO DE LICENCIA", "licencia")
                ->label(fn ($row) => view(
                    'livewire.medicine.tables.actions.clasification-classes',
                    [
                        $licencia = MedicineReserve::with([
                            'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
                        ])->where('id', $row->id)->get(),
                        'licencias' => $licencia
                    ]
                )),

            Column::make("SEDE", "medicineSchedule.sede")
                ->sortable(),

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
                    'livewire.medicine.tables.actions.download-file',
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
        return $action = MedicineReserve::query()
            ->where('users.name', '!=', 'admin');
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
                    'CANCUN QUINTANA ROO' => 'CANCUN QUINTANA ROO',
                    'TIJUANA BC' => 'TIJUANA BC',
                    'TOLUCA AEROPUERTO' => 'TOLUCA AEROPUERTO',
                    'MONTERREY AEROPUERTO' => 'MONTERREY AEROPUERTO',
                    'GUADALAJARA AEROPUERTO' => 'GUADALAJARA AEROPUERTO',
                    'CIUDAD DE MÉXICO AEROPUERTO BJ' => 'CIUDAD DE MÉXICO AEROPUERTO BJ',
                    'MAZATLAN SINALOA' => 'MAZATLAN SINALOA',
                    'TUXTLA GTZ. CHIAPAS' => 'TUXTLA GTZ. CHIAPAS',
                    'VERACRUZ VERACRUZ' => 'VERACRUZ VERACRUZ',
                    'HERMOSILLO SONORA' => 'HERMOSILLO SONORA',
                    'QUERETARO QRO' => 'QUERETARO QRO',
                    'MERIDA YUC' => 'MERIDA YUC'
                ])
                ->filter(function ($query, $value) {
                    $query->where('sede', $value);
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
            $query = MedicineReserve::with([
                'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
            ])->whereIn('id', $this->getSelected());
            $results = $query->get();
            $job = new ExportSelectedJob($results);
            dispatch($job); // Agregar el trabajo a la cola
        } else {
            // Lógica para manejar el caso en el que no se hayan seleccionado registros
        }
    }
}
