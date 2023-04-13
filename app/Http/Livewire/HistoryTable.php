<?php

namespace App\Http\Livewire;

use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class HistoryTable extends PowerGridComponent
{
    use ActionButton;

    // public int $perPage = 5;
    // public array $perPageValues = [0, 5, 10, 20, 50];
    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            // Exportable::make('export')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
            ->showSearchInput(),
            // ->withoutLoading(),

           Footer::make()
           ->includeViewOnTop('components.datatable.footer-top')
              ->showPerPage()
                // ->showPerPage($this->perPage, $this->perPageValues)
              ->showRecordCount(),
                // ->showRecordCount(mode: 'full')

                // ->showPerPage(1)
                // ->showRecordCount()
                // ->pagination(''),

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
        
        return MedicineReserve::query()->with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user']);
    
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
        return [];
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
            ->addColumn('FullName',function ($row){
                return $row->medicineReserveMedicine->medicineUser->name;                
            })
            ->addColumn('Type',function ($row){
                return $row->medicineReserveMedicine->medicineTypeExam->name;                
            })
            ->addColumn('Class',function ($row){
                if($row->medicineReserveMedicine->medicineTypeExam->id == 1){
                    return $row->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name;                
                }
            })

            ;



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
            Column::make('NOMBRE', 'FullName'),
            Column::Make('TIPO', 'Type'),
            Column::Make('CLASE', 'Class'),            
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

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('medicine-reserve.edit', ['medicine-reserve' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('medicine-reserve.destroy', ['medicine-reserve' => 'id'])
               ->method('delete')
        ];
    }
    */

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
