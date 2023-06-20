<?php

namespace App\Http\Livewire\Linguistics\Tables;

use App\Models\Linguistic\LinguisticReserve;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AppointmentTable extends DataTableComponent
{

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


                ];
    }

    public function builder(): Builder
    {
            return LinguisticReserve::query()->with([
                'linguisticReserveFromUser:name',
                'linguisticReserveFromUser.UserPart:apParental,apMaternal',
                'linguisticReserve.linguisticTypeExam:name',
                'linguisticReserve.linguisticTypeLicense:name',
                'linguisticReserve:license_number,red_number,reference_number,time_start'
            ]);
    }




}
