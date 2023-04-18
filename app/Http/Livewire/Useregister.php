<?php

namespace App\Http\Livewire;

use App\Models\UserParticipant;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
//use App\Models\UserParticipant;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class Useregister extends PowerGridComponent
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
                ->showPerPage(50)
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
    * @return Builder<\App\Models\UserParticipant>
    */
    public function datasource(): Builder
    {
        return UserParticipant::query()->with([
            'userParticipantUser'
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
            'userParticipantUser' => [
                'name',
            ],
            'userParticipantUser' => [
                'curp',
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
            ->addColumn('name',function (UserParticipant $user) {
                return $user->userParticipantUser->name.' '.$user->apParental.' '.$user->apMaternal;
            })
            ->addColumn('curp')
           /** Example of custom column using a closure **/
            ->addColumn('name_lower', function (UserParticipant $model) {
                return strtolower(e($model->name));
            })
            ->addColumn('email',function (UserParticipant $user) {
                return $user->userParticipantUser->email;
            })
           
            ->addColumn('genre')
            ->addColumn('birth', fn (UserParticipant $model) => Carbon::parse($model->birth)->format('d/m/Y'))
            ->addColumn('age')
            ->addColumn('domicile',function (UserParticipant $user) {
                return $user->street.' No.'.$user->nInterior.' No.ext.'.$user->nExterior.' '.$user->suburb.' ,'.$user->postalCode.' ,'.$user->delegation.' ,'.$user->federalEntity;
            })
            ->addColumn('mobilePhone')
            ->addColumn('officePhone')
            ->addColumn('extension')
            ->addColumn('created_at_formatted', fn (UserParticipant $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (UserParticipant $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            Column::make('Nombre', 'name')
                ->sortable()
                ->searchable(),
                //->makeInputText(),
            Column::make('CURP', 'curp')
                ->sortable()
                ->searchable(),
                //->makeInputText(),

           Column::make('correo', 'email')
                ->sortable()
                ->searchable(),
                //->makeInputText(),

            Column::make('Genero', 'genre')
                ->sortable()
                ->searchable(),
                //->makeInputText(),
            
            Column::make('Fecha de nacimiento', 'birth')
                ->sortable()
                ->searchable(),
                //->makeInputText(),
            Column::make('Edad', 'age')
                ->sortable()
                ->searchable(),
                //->makeInputText(),
            Column::make('Dirección', 'domicile')
                ->sortable()
                ->searchable(),
                //->makeInputText(),
            
            Column::make('Celular', 'mobilePhone')
                ->sortable()
                ->searchable(),
                //->makeInputText(),
            
            Column::make('Oficina', 'officePhone')
                ->sortable()
                ->searchable(),
                //->makeInputText(),
            
            Column::make('Extensión', 'extension')
                ->sortable()
                ->searchable(),
                //->makeInputText(),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->sortable()
                ->searchable(),
                //->makeInputText(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
                ->sortable()
                ->searchable(),
                //->makeInputText(),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid User Action Buttons.
     *
     * @return array<int, Button>
     */

    
    public function actions(): array
    {
       return [
           /*Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('user.edit', ['user' => 'id']),*/

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('afac.historyRegister', ['user' => 'id'])
               ->method('delete')
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
     * PowerGrid User Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($user) => $user->id === 1)
                ->hide(),
        ];
    }
    */
}
