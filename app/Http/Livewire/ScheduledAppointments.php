<?php

namespace App\Http\Livewire;

use App\Exports\ScheduledExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class ScheduledAppointments extends DataTableComponent
{
    // protected $model = Medicine\MedicineReserve::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setBulkActions([
            'exportSelected' =>'EXPORTAR'
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
                ->searchable(fn($query, $searchTerm)=> $query->orWhere('name','like','%'.$searchTerm.'%')),

                Column::make("SEDE", "user.userHeadquarter.name")
                ->sortable(),


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
                ->sortable(),

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
        return MedicineReserve::query();
        // ->with('medicineReserveFromUser');
        // ->OrWhere('users.name','MANOLO');
    //  ->select('medicineReserveFromUser.id as names');
    }

    public function exportSelected(){

    if($this->getSelected()){

    $medreser = MedicineReserve::with([
        'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
    ])->whereIn('id',$this->getSelected())->get();

    return Excel::download(new ScheduledExport($medreser), 'scheduled.xlsx');
    // $this->clearSelected();

    }else{

    }
        // $this->emit('error, No hay registros selecionados');
    }
}
