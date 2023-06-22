<?php

namespace App\Http\Livewire\Catalogue\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Catalogue\ClasificationClass;

class ClasificationclassesTable extends DataTableComponent
{
    protected $model = ClasificationClass::class;
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'clasifications' => '$refresh'
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
            Column::make("Tipo de examen", "clasificationClassTypeClass.name")
                ->sortable(),
                Column::make("ACCIÓN")
                ->label(
                    fn ($row) => view(
                        'components.catalogue.clasification-component',
                        [
                            $action = ClasificationClass::where('id', $row->id)->get(),
                            'name' => $action[0]->name,
                            'classificId' => $action[0]->id,
                        ]
                    )
                ),
        ];
    }
}
