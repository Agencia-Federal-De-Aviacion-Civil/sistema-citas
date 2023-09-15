<?php

namespace App\Http\Livewire\Permissions\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;

class RoleTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'asc');
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("ACCIÓN")
                ->label(
                    fn ($row) => view(
                        'components.permissions.role-action-component',
                        [
                            'rolesId' => $row->id
                        ]
                    )
                ),
        ];
    }
    public function builder(): Builder
    {
        return Role::query();
    }
}
