<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use Spatie\Permission\Models\Permission;

final class PermissionTable extends PowerGridComponent
{
    use ActionButton;

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'createPermissions' => '$refresh',
            ]
        );
    }
    public function datasource(): Builder
    {
        return Permission::query();
    }


    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */
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
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('description');
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
                ->searchable()
                ->sortable(),

            Column::make('NOMBRE', 'name')
                ->searchable()
                ->sortable(),
            Column::make('DESCRIPCIÓN', 'description')
                ->searchable()
                ->sortable(),
        ];
    }
    public function actions(): array
    {
        return [
            Button::add('edit-permission')
                ->bladeComponent('edit-permission', ['permissionId' => 'id']),
        ];
    }
}
