<?php

namespace App\Http\Livewire;

use App\Models\Medicine\MedicineReserve;
use App\Models\UserParticipant;
// use DeepCopy\Filter\Filter;
use PowerComponents\LivewirePowerGrid\Traits\Filter;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class recordappointment extends PowerGridComponent
{
    use ActionButton;

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
    public function setUp(): array
    {
        // $this->showCheckBox();
        // $this->persist(['columns', 'filters']);
        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showSearchInput()
                ->showToggleColumns(),
            Footer::make()
                ->showPerPage(25)
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Medicine\MedicineReserve>
     */
    public function datasource(): Builder
    {
        if (Auth::user()->can('see.navigation.controller.systems')) {
            return MedicineReserve::query()->with([
                'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
            ]);
        } else {
            return MedicineReserve::query()->with([
                'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
            ])->whereHas('medicineReserveMedicine', function ($q1) {
                $q1->where('user_id', Auth::user()->id);
            });
        }
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [
            'medicineReserveFromUser' => [
                'name',
            ],
            'medicineReserveMedicine.medicineTypeExam' => [
                'name',
            ],
            'userParticipantUser' => [
                'apParental',
                'apMaternal',
            ],

        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('name', function (MedicineReserve $regiser) {
                return $regiser->medicineReserveFromUser->name . ' ' . $regiser->userParticipantUser->apParental . ' ' . $regiser->userParticipantUser->apMaternal;
                //return $regiser->medicineReserveFromUser->name;
            })

            ->addColumn('folio', function (MedicineReserve $type) {
                return 'MED-' . $type->medicineReserveMedicine->id;
            })
            ->addColumn('type', function (MedicineReserve $type) {
                return $type->medicineReserveMedicine->medicineTypeExam->name;
            })
            ->addColumn('hours', function (MedicineReserve $type) {
                return $type->reserveSchedule->time_start;
            })
            ->addColumn('class', function (MedicineReserve $class) {
                if ($class->medicineReserveMedicine->medicineTypeExam->id == 1) {
                    return $class->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name;
                } else if ($class->medicineReserveMedicine->type_exam_id == 2) {
                    return $class->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name;
                }
            })
            ->addColumn('typelicens', function (MedicineReserve $class) {
                if ($class->medicineReserveMedicine->medicineTypeExam->id == 1) {
                    return $class->medicineReserveMedicine->medicineInitial[0]->medicineInitialClasificationClass->name;
                } else if ($class->medicineReserveMedicine->type_exam_id == 2) {
                    return $class->medicineReserveMedicine->medicineRenovation[0]->renovationClasificationClass->name;
                }
            })
            ->addColumn('headquarters', function (MedicineReserve $headquarters) {
                return $headquarters->user->name;
            })
            ->addColumn('curp', function (MedicineReserve $regiser) {
                return $regiser->userParticipantUser->curp;
            })
            ->addColumn('reference_number', function (MedicineReserve $regiser) {
                return $regiser->medicineReserveMedicine->reference_number;
            })
            ->addColumn('genre', function (MedicineReserve $regiser) {
                return $regiser->userParticipantUser->genre;
            })
            ->addColumn('birth', function (MedicineReserve $regiser) {
                return $regiser->userParticipantUser->birth;
            })
            ->addColumn('state_id', function (MedicineReserve $regiser) {
                return $regiser->userParticipantUser->state_id;
            })
            ->addColumn('state_id', function (MedicineReserve $regiser) {
                return $regiser->userParticipantUser->municipal_id;
            })
            ->addColumn('age', function (MedicineReserve $regiser) {
                return $regiser->userParticipantUser->age;
            })
            ->addColumn('domicile',function (MedicineReserve $regiser) {
                return $regiser->userParticipantUser->street.' No.'.$regiser->userParticipantUser->nInterior.' No.ext.'.$regiser->userParticipantUser->nExterior.' '.$regiser->userParticipantUser->suburb.' ,'.$regiser->userParticipantUser->postalCode.' ,'.$regiser->userParticipantUser->delegation.' ,'.$regiser->userParticipantUser->federalEntity;
            })
            ->addColumn('mobilePhone',function (MedicineReserve $regiser) {
                return $regiser->userParticipantUser->mobilePhone;
            })
            ->addColumn('officePhone',function (MedicineReserve $regiser) {
                return $regiser->userParticipantUser->officePhone;
            })
            ->addColumn('extension',function (MedicineReserve $regiser) {
                return $regiser->userParticipantUser->extension;
            })


            //state_id
            ->addColumn('created_at_formatted', fn (MedicineReserve $model) => Carbon::parse($model->dateReserve)->format('d/m/Y H:i:s'))
            ->addColumn('created_at_formatted', fn (MedicineReserve $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
        //->addColumn('updated_at_formatted', fn (MedicineReserve $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));

    }

    // public function filters(): array
    // {
    //     return [
    //        Filter::inputText('name', 'name')
    //           ->operators(['contains', 'is', 'is_not']),
    //     ];
    // }
    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
            ->searchable(),

            // Column::make('FOLIO', 'folio')
            //     ->searchable(),
            // ->sortable()
            // ->makeInputText(),

            Column::make('NOMBRE', 'name')
                ->searchable(),
                //->makeInputText(),

            // ->sortable(),
            //->makeInputDatePicker(),

            Column::make('TIPO', 'type')
                ->searchable(),
            // ->makeInputText(),
            // ->sortable(),
            //->makeInputDatePicker(),

            Column::make('CLASE', 'class')
                ->searchable(),
            // ->sortable(),
            //->makeInputDatePicker(),

            Column::make('TIPO DE LICENCIA', 'typelicens')
                ->searchable(),
            // ->sortable(),
            //->makeInputDatePicker(),

            Column::make('SEDE', 'headquarters')
                ->searchable(),
            // ->sortable(),
            //->makeInputDatePicker(),

            Column::make('FECHA', 'dateReserve')
                ->searchable(),
            // ->sortable(),

            Column::make('HORA', 'hours')
                ->searchable(),
            // ->sortable(),
            //->makeInputDatePicker(),

            Column::make('CURP', 'curp')
                ->searchable()
                ->sortable(),
            //->makeInputDatePicker(),

            Column::make('PAGO', 'reference_number')
                ->searchable()
                ->sortable(),

            Column::make('GENERO', 'genre')
                ->searchable()
                ->sortable(),

            Column::make('FECHA DE NACIMIENTO', 'birth')
                ->searchable()
                ->sortable(),

            Column::make('ESTADO DE NACIMIENTO', 'state_id')
                ->searchable()
                ->sortable(),

            Column::make('EDAD', 'age')
                ->searchable()
                ->sortable(),

            Column::make('DIRECCIÓN', 'domicile')
                ->sortable()
                ->searchable(),

            Column::make('CELULAR', 'mobilePhone')
                ->sortable()
                ->searchable(),

            Column::make('OFICINA', 'officePhone')
                ->sortable()
                ->searchable(),

            Column::make('EXTENSIÓN', 'extension')
                ->sortable()
                ->searchable(),
                //->makeInputText(),

            //  Column::make('CREADA EL', 'created_at_formatted', 'created_at')
            //     ->searchable()
            //     ->sortable(),
            //->makeInputDatePicker(),

            //Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
            //    ->searchable()
            //    ->sortable(),
            //->makeInputDatePicker(),


        ];
    }
    public function filters(): array
    {
        return [
            Filter::InputText('curp','curp')
            ->operators(['contains', 'is', 'is_not']),
        ];
    }

    // public function filters(): array
    // {

        // ->dataSource(UserParticipant::select('curp')->distinct()->get())
        // ->optionValue('curp')
        // ->optionLabel('curp'),
    //     return [
    //        Filter::inputText('curp', 'curp'),
    //         //   ->operators(['contains', 'is', 'is_not']),
    //     ];
    // }
    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid MedicineReserve Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::add('schedule-button-component')
                ->bladeComponent('schedule-component', ['scheduleId' => 'id', 'status' => 'status']),
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid MedicineReserve Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($medicine-reserve) => $medicine-reserve->id === 1)
                ->hide(),
        ];
    }
    */
}
