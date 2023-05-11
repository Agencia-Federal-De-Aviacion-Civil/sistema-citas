<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

// use App\Models\User;

class ScheduledAppointments extends DataTableComponent
{
    // protected $model = MedicineReserve::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [

            Column::make("Id", "id")
                ->sortable(),

                Column::make("Nombre", "medicineReserveFromUser.name")
                ->sortable()
                ->searchable(fn($query, $searchTerm)=> $query->orWhere('name','like','%'.$searchTerm.'%')),

                Column::make("Apellido Paterno", "userParticipantUser.apParental")
                ->sortable(),

                Column::make("Apellido Materno", "userParticipantUser.apMaternal")
                ->sortable(),

                Column::make("Tipo", "medicineReserveMedicine.medicineTypeExam.name")
                ->sortable(),

                    Column::make("Clase", "medicineReserveMedicine.medicineInitial.medicineInitialTypeClass.name")
                    ->sortable(),

                    Column::make("TIPO DE LICENCIA", "medicineReserveMedicine.medicineInitial.medicineInitialClasificationClass.name")
                    ->sortable(),


                // Column::make("Clase", "medicineReserveMedicine.medicineInitial.medicineInitialTypeClass.name")
                // ->sortable(),

                // Column::make("TIPO DE LICENCIA", "medicineReserveMedicine.medicineInitial.medicineInitialClasificationClass.name")
                // ->sortable(),

                Column::make("SEDE", "medicineReserveFromUser.userHeadquarter.headquarterUser.name")
                ->sortable(),

                Column::make("FECHA", "dateReserve")
                ->sortable(),

                Column::make("HORA", "medicineSchedule.time_start")
                ->sortable(),

                Column::make("CURP", "userParticipantUser.curp")
                ->sortable(),

                Column::make("LLAVE DE PAGO", "medicineReserveMedicine.reference_number")
                ->sortable(),

                Column::make("Clase", "medicineReserveMedicine.medicineRenovation.renovationTypeClass.name")
                ->sortable(),

                Column::make("Fecha de creación", "created_at")
                ->sortable(),
            // Column::make("Updated at", "updated_at")
            //     ->sortable(),
        ];
    }



    public function builder(): Builder
    {

        return MedicineReserve::query()
        ->with('medicineReserveFromUser');
        // ->OrWhere('users.name','MANOLO');
    //  ->select('medicineReserveFromUser.id as names');
    }
    //     ->join('users', function ($user) {
    //         $user->on('medicine_reserves.from_user_appointment', '=', 'users.id');
    //     });

        // if (Auth::user()->can('see.navigation.controller.systems')) {
        // return MedicineReserve::query()
        // ->leftjoin('users','medicine_reserves.from_user_appointment', '=' ,'users.id')
        // ->select();
// ->select('users.name as name');
// ->with([
// 'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser','medicineReserveMedicine.medicineInitial'
// ]);


        // }
        // 'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
        // else {
        //     return MedicineReserve::query()->with([
        //         'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
        //     ])->whereHas('medicineReserveMedicine', function ($q1) {
        //         $q1->where('user_id', Auth::user()->id);
        //     });
        // }
    // }

}
