<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class UserManager extends PowerGridComponent
{
    use ActionButton;
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'privilegesUser' => '$refresh',
                'deleteUser' => '$refresh',
            ]
        );
    }
    /*
|--------------------------------------------------------------------------
|  Features Setup
|--------------------------------------------------------------------------
| Setup Table's general features
|
*/
    public function setUp(): array
    {
        $this->showCheckBox();
        // $this->includeViewOnBottom('privileges-component');
        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showSearchInput()
                ->includeViewOnTop('components.privileges-component'),

            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
|--------------------------------------------------------------------------
|  Datasource
|--------------------------------------------------------------------------
| Provides data to your Table using a qModel or Collection
|
*/

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\User>
     */
    public function datasource(): Builder
    {
        return User::query()->with(['roles'])->where('status', 0);
        // $user=User::with(['roles'])->findOrFail(1);
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
            ->addColumn('name')
            /** Example of custom column using a closure **/
            // ->addColumn('name_lower', function (User $model) {
            //     return strtolower(e($model->name));
            // })

            ->addColumn('email')
            // ->addColumn('created_at_formatted', fn (User $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            // ->addColumn('updated_at_formatted', fn (User $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'))

            ->addColumn('privileges', function (User $privileges) {
                if ($privileges->roles[0]->name == 'super_admin') {
                    return 'SUPER ADMINISTRADOR';
                } elseif ($privileges->roles[0]->name == 'medicine_admin') {
                    return 'MEDICINA ADMINISTRADOR';
                } elseif ($privileges->roles[0]->name == 'linguistic_admin') {
                    return 'LINGÜÍSTICA ADMINISTRADOR';
                } elseif ($privileges->roles[0]->name == 'user') {
                    return 'USUARIO';
                } elseif ($privileges->roles[0]->name == 'headquarters') {
                    return 'SEDE';
                }
            })


            // ->addColumn('curp', function ($regiser) {
            //     return $regiser->userParticipantUser->curp;
            // })            

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
            // ->makeInputRange(),

            Column::make('NOMBRE', 'name')
                ->sortable()
                ->searchable(),
            // ->makeInputText(),

            Column::make('CORREO', 'email')
                ->sortable()
                ->searchable(),

            Column::make('ROL', 'privileges')
                ->sortable()
                ->searchable(),


            // ->makeInputText(),

            // Column::make('CREATED AT', 'created_at_formatted', 'created_at')
            //     ->searchable()
            //     ->sortable()
            //     ->makeInputDatePicker(),

            // Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
            //     ->searchable()
            //     ->sortable()
            //     ->makeInputDatePicker(),

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
     * PowerGrid User Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        // privileges
        return [
            Button::add('privileges-button-component')
                ->bladeComponent('privileges-component', ['privilegesId' => 'id']),
        ];
    }
    /*
public function actions(): array
{
return [
Button::make('edit', 'Edit')
->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
->route('user.edit', ['user' => 'id']),

Button::make('destroy', 'Delete')
->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
->route('user.destroy', ['user' => 'id'])
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
