<?php

namespace App\Http\Livewire\Catalogue\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Catalogue\TypeClass;

class TypeclassesTable extends DataTableComponent
{
    protected $model = TypeClass::class;
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'classes' => '$refresh'
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
            Column::make("Tipo de examen", "typeClassTypeExam.name")
                ->sortable(),
            Column::make("Pregunta", "typeClassMedicineQuestion.name")
                ->sortable(),
            Column::make("ACCIÓN")
                ->label(
                    fn ($row) => view(
                        'components.catalogue.classes-component',
                        [
                            $action = TypeClass::where('id', $row->id)->get(),
                            'name' => $action[0]->name,
                            'classId' => $action[0]->id,
                        ]
                    )
                ),
        ];
    }
}
