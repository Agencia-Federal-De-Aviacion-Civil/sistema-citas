<?php

namespace App\Http\Livewire;

use App\Exports\ScheduledExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ScheduledAppointments extends DataTableComponent
{
    // protected $model = Medicine\MedicineReserve::class;
    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setBulkActions([
            'exportSelected' => 'EXPORTAR'
        ]);
    }

    public function columns(): array
    {


        // if("medicineReserveMedicine.medicineTypeExam.id"=='1'){
        //     $nameClass = 'es';
        // //     $nameClass = "medicineReserveMedicine.medicineInitial.medicineInitialTypeClass.name";
        // //     // $typeLicense = medicineReserveMedicine->medicineInitial->medicineInitialClasificationClass->name;
        // }else if("medicineReserveMedicine.medicineTypeExam.id"=='2'){
        //     $nameClass = 'no';
        // //     $nameClass = "medicineReserveMedicine.medicineRenovation.renovationTypeClass.name";
        // //     // $typeLicense = medicineReserveMedicine->medicineRenovation->renovationClasificationClass->name;
        // }

        return [

            Column::make("Id", "id")
                ->sortable(),

            Column::make("Nombre", "medicineReserveFromUser.name")
                ->sortable()
                ->searchable(),
            // ->searchable(fn($query, $searchTerm)=> $query->orWhere('name','like','%'.$searchTerm.'%')),

            // Column::make("SEDE", "user.userHeadquarter.name")
            // ->sortable(),

                Column::make("Nombre", "medicineReserveMedicine.medicineUser.name")
                ->sortable(),
                // ->searchable(fn($query, $searchTerm)=> $query->orWhere('users.name','like','%'.$searchTerm.'%')),

            Column::make("Apellido Paterno", "userParticipantUser.apParental")
                ->sortable(),

            Column::make("Apellido Materno", "userParticipantUser.apMaternal")
                ->sortable(),

            Column::make("Tipo", "medicineReserveMedicine.medicineTypeExam.name")
                ->sortable(),

            // Column::make("Clase", $nameClass)
            // ->sortable(),

            // if(medicineReserveMedicine.medicineTypeExam.id==1){

            //CONSULTA DE INICIAL
            // Column::make("Clase", $clas)
            // ->sortable(),
            // Column::make("TIPO DE LICENCIA", "medicineReserveMedicine.medicineInitial.medicineInitialClasificationClass.name")
            // ->sortable(),

            // // }elseif(medicineReserveMedicine.medicineTypeExam.id==2){

            // //CONSULTA DE RENOVACIÓN
            // /*Column::make("Clase", "medicineReserveMedicine.medicineRenovation.renovationTypeClass.name")
            // ->sortable(),
            // Column::make("TIPO DE LICENCIA", "medicineReserveMedicine.medicineRenovation.renovationClasificationClass.name")
            // ->sortable(),*/
            // // }


            Column::make("FECHA", "dateReserve")
            ->sortable()
            ->searchable(),

            Column::make("HORA", "medicineSchedule.time_start")
                ->sortable(),

            Column::make("CURP", "userParticipantUser.curp")
                ->sortable(),

            Column::make("LLAVE DE PAGO", "medicineReserveMedicine.reference_number")
                ->sortable(),

            // Column::make("Clase", "medicineReserveMedicine.medicineRenovation.renovationTypeClass.name")
            // ->sortable(),

            Column::make("Fecha de creación", "created_at")
                ->sortable(),
            // Column::make("Updated at", "updated_at")
            //     ->sortable(),
        ];
    }
    public function builder(): Builder
    {
        return $valor = MedicineReserve::query()->selectRaw('users.name as names');
        // ->with([
        //     'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
        // ])->select('user.name as name')->get();
        // ->with('medicineReserveFromUser');
        // ->OrWhere('users.name','MANOLO');
        //  ->select('medicineReserveFromUser.id as names');
    }

    public function exportSelected()
    {
        if ($this->getSelected()) {
            $query = MedicineReserve::with([
                'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
            ])->whereIn('id', $this->getSelected());

            $results = $query->get();

            $filePath = 'uploads/citas-app/medicine/exports/scheduled.xlsx';

            Excel::queue(new ScheduledExport($results), $filePath, 'do');

            // Eliminar el archivo después de la exportación utilizando colas
            Queue::after(function () use ($filePath) {
                Storage::disk('do')->delete($filePath);
            });

            return 'La exportación se ha agregado a la cola de trabajos.';
        } else {
            // Lógica para manejar el caso en el que no se hayan seleccionado registros
        }
    }
}
