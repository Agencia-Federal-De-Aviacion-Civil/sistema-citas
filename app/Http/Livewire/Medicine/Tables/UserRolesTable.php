<?php

namespace App\Http\Livewire\Medicine\Tables;

use App\Models\User;
use App\View\Components\ActionRoles;
use Aws\RolesAnywhere\RolesAnywhereClient;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Jetstream\Rules\Role;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use WireUi\Traits\Actions;

class UserRolesTable extends DataTableComponent
{

    use Actions;
    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setBulkActions([
            'exportSelected' => 'EXPORTAR'
        ]);
        $this->setOfflineIndicatorEnabled();
        $this->setEagerLoadAllRelationsEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make('NOMBRE', 'name')
                ->sortable()
                ->searchable(),
            Column::make('APELLIDO PATERNO', 'UserPart.apParental')
            ->sortable()
            ->searchable(),

            Column::make('APELLIDO MATERNO', 'UserPart.apMaternal')
            ->sortable()
            ->searchable(),

            // ->makeInputText(),
            Column::make('CORREO', 'email')
                ->sortable()
                ->searchable(),

            // Column::make('ROL', 'guard_name')
            //     ->sortable()
            //     ->searchable(),



        ];
    }
    // public function render()
    // {
    //     return view('livewire.medicine.tables.user-roles-table');
    // }
    public function builder(): Builder
    {
        return
        User::query()->with(['roles', 'UserPart'])
            ->where('status', 0)
            ->where('users.id', '<>', 1)
            ->whereHas('roles', function ($q1) {
                $q1->where('roles.id', '<>', 5);
            });
    }
}
