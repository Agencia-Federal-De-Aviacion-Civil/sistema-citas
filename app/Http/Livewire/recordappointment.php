<?php

namespace App\Http\Livewire;

use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class recordappointment extends PowerGridComponent
{
    use ActionButton;



    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        //$this->showCheckBox();

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
        return MedicineReserve::query()->with([
            'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
        ]);
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
            /*'medicineReserveFromUser?' => [
                 'apParental',
             ],*/

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
                return $regiser->medicineReserveFromUser->name . ' ' . $regiser->userParticipantUser?->apParental . ' ' . $regiser->userParticipantUser?->apMaternal;
                //return $regiser->medicineReserveFromUser->name;
            })
            ->addColumn('folio', function (MedicineReserve $type) {
                return 'MED-' . $type->medicineReserveMedicine->id;
            })
            ->addColumn('type', function (MedicineReserve $type) {
                return $type->medicineReserveMedicine->medicineTypeExam->name;
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
                return $regiser->userParticipantUser?->curp;
            })
            ->addColumn('dateReserve', fn (MedicineReserve $model) => Carbon::parse($model->dateReserve)->format('d/m/Y H:i:s'))
            ->addColumn('created_at_formatted', fn (MedicineReserve $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
        //->addColumn('updated_at_formatted', fn (MedicineReserve $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));

    }

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
            Column::make('ID', 'id'),
            //->makeInputRange(),

            Column::make('FOLIO', 'folio')
                ->searchable(),
            //->sortable(),
            //->makeInputDatePicker(),

            Column::make('NOMBRE', 'name')
                ->searchable(),
            //->sortable(),
            //->makeInputDatePicker(),

            Column::make('TIPO', 'type')
                ->searchable()
                ->sortable(),
            //->makeInputDatePicker(),

            Column::make('CLASE', 'class')
                ->searchable()
                ->sortable(),
            //->makeInputDatePicker(),

            Column::make('TIPO DE LICENCIA', 'typelicens')
                ->searchable()
                ->sortable(),
            //->makeInputDatePicker(),

            Column::make('SEDE', 'headquarters')
                ->searchable()
                ->sortable(),
            //->makeInputDatePicker(),

            Column::make('FECHA Y HORA DE LA CITA', 'dateReserve')
                ->searchable()
                ->sortable(),
            //->makeInputDatePicker(),

            Column::make('CURP', 'curp')
                ->searchable()
                ->sortable(),
            //->makeInputDatePicker(),

            Column::make('CREADA EL', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable(),
            //->makeInputDatePicker(),

            //Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
            //    ->searchable()
            //    ->sortable(),
            //->makeInputDatePicker(),

        ];
    }

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
                ->bladeComponent('schedule-component', ['scheduleId' => 'id']),
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
