<?php

namespace App\Http\Livewire\Permissions\Tables;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Spatie\Permission\Models\Permission;

class PermissionTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'createPermissions' => '$refresh',
                'deletePermissions' => '$refresh'
            ]
        );
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("NOMBRE", "name")
                ->sortable(),
            Column::make("DESCRIPCIÓN", "description")
                ->sortable(),
            Column::make("ACCIÓN")
                ->label(
                    fn ($row) => view(
                        'permissions.permission-action-component',
                        [
                            'permissionId' => $row->id
                        ]
                    )
                ),
        ];
    }
    public function builder(): Builder
    {
        return Permission::query();
    }
}
