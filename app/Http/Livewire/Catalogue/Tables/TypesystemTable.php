<?php

namespace App\Http\Livewire\Catalogue\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\System;

class TypesystemTable extends DataTableComponent
{
    protected $model = System::class;
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'systems' => '$refresh'
            ]
        );
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "name")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("ACCIÓN")
                ->label(
                    fn ($row) => view(
                        'components.catalogue.catalogue-component',
                        [
                            $action = System::where('id', $row->id)->get(),
                            'name' => $action[0]->name,
                            'catalogsId' => $action[0]->id,
                        ]
                    )
                ),
        ];
    }
}
