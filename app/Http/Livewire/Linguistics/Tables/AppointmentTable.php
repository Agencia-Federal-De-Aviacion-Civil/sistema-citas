<?php

namespace App\Http\Livewire\Linguistics\Tables;

use App\Models\Linguistic\LinguisticReserve;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
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
        $this->setDefaultSort('id','asc');
    }

    public function columns(): array
    {
            return [
                Column::make("Id", "id")
                    ->sortable(),

                Column::make("Nombre", "linguisticReserveFromUser.name")
                    ->sortable()
                    ->searchable(fn ($query, $searchTerm) => $query->orWhere('users.name', 'like', '%' . $searchTerm . '%')),

                Column::make("Apellido Paterno", "linguisticReserveFromUser.UserPart.apParental")
                    ->sortable()
                    ->searchable(fn ($query, $searchTerm) => $query->orWhere('apParental', 'like', '%' . $searchTerm . '%')),


                Column::make("Apellido Materno", "linguisticReserveFromUser.UserPart.apMaternal")
                    ->sortable()
                    ->searchable(fn ($query, $searchTerm) => $query->orWhere('apMaternal', 'like', '%' . $searchTerm . '%')),

                    Column::make("Tipo", "linguisticReserve.linguisticTypeExam.name")
                    ->sortable(),

                    Column::make("Tipo Licencia", "linguisticReserve.linguisticTypeLicense.name")
                    ->sortable(),

                    Column::make("Número Licencia", "linguisticReserve.license_number")
                    ->sortable(),

                    Column::make("Número Rojo", "linguisticReserve.red_number")
                    ->sortable(),

                    Column::make("Lave Pago", "linguisticReserve.reference_number")
                    ->sortable(),

                    Column::make("Sede", "sede")
                    ->label(fn ($row) => view(
                        'afac.linguistics.tables.appointmentTable.actions.sedes-filter',
                        [
                            $sede = LinguisticReserve::with([
                                'linguisticReserveFromUser','linguisticUserHeadquers'
                            ])->where('id', $row->id)->get(),
                            'sede' => $sede
                        ]
                    )),
                    Column::make("Fecha", "date_reserve")
                    ->sortable()
                    ->searchable()
                    ->format(fn ($value) => Carbon::parse($value)->format('d/m/Y')),

                    Column::make("Hora", "linguisticReserveSchedule.time_start")
                    ->sortable(),

                    Column::make("ACCIÓN")
                    ->label(
                        fn ($row) => view(
                            'components.linguistic.schedule-component',
                            [
                                $action = LinguisticReserve::where('id', $row->id)->get(),
                                'status' => $action[0]->status,
                                'scheduleId' => $action[0]->id,
                                'linguisticId' => $action[0]->linguistic_id
                            ]
                        )
                    ),


                ];
    }

    public function builder(): Builder
    {
            return LinguisticReserve::query()->with([
                'linguisticReserveFromUser:name',
                'linguisticReserveFromUser.UserPart:apParental,apMaternal',
                'linguisticReserve.linguisticTypeExam:name',
                'linguisticReserve.linguisticTypeLicense:name',
                'linguisticReserve:license_number,red_number,reference_number',
                'linguisticReserveSchedule.time_start'
            ]);
    }
    public function filters(): array
    {
        if (Auth::user()->can('super_admin.medicine_admin.see.schedule.table') || Auth::user()->can('headquarters.see.schedule.table')) {
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
                        '3' => 'CANCELÓ',
                        '4' => 'REAGENDADA',
                        '5' => 'LIBERADA'

                    ])
                    ->filter(function ($query, $value) {
                        $query->where('linguistic_reserves.status', $value);
                    }),

                DateFilter::make('Desde')
                    ->filter(function ($query, $value) {
                        $query->whereDate('date_Reserve', '>=', $value);
                    }),

                DateFilter::make('Hasta')
                    ->filter(function ($query, $value) {
                        $query->whereDate('date_Reserve', '<=', $value);
                    }),
                SelectFilter::make('SEDE')
                    ->options([
                        '' => 'TODOS',
                        '2' => 'PRUEBA',
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

                TextFilter::make('ID CITA')
                    ->config([
                        'placeholder' => 'Buscar cita',
                    ])
                    ->filter(function (Builder $builder, string $value) {
                        $builder->where('linguistic_reserves.id', 'like', '%' . $value . '%');
                    }),
            ];
        } else {
            return [];
        }
    }

}
