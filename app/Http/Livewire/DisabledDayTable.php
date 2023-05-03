<?php

namespace App\Http\Livewire;

use App\Models\Medicine\MedicineDisabledDays;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class DisabledDayTable extends PowerGridComponent
{
    use ActionButton;

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'disabledRecord' => '$refresh',
                'deleteDay' => '$refresh'
            ]
        );
    }
    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            // Exportable::make('export')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
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
     * @return Builder<\App\Models\Medicine\MedicineDisabledDays>
     */
    public function datasource(): Builder
    {
        return MedicineDisabledDays::query();
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
            ->addColumn('disabled_days', fn (MedicineDisabledDays $model) => Carbon::parse($model->disabled_days)->format('d/m/Y'));
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
            Column::make('ID', 'id')
                ->sortable(),
            // ->makeInputRange(),

            Column::make('FECHAS DESHABILITADAS', 'disabled_days')
                ->searchable()
                ->sortable(),
            // ->makeInputDatePicker(),

            // Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
            //     ->searchable()
            //     ->sortable(),
            // ->makeInputDatePicker(),

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
     * PowerGrid MedicineDisabledDays Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::add('delete-schedule')
                ->bladeComponent('delete-schedule', ['deleteId' => 'id']),
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
     * PowerGrid MedicineDisabledDays Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($medicine-disabled-days) => $medicine-disabled-days->id === 1)
                ->hide(),
        ];
    }
    */
}
