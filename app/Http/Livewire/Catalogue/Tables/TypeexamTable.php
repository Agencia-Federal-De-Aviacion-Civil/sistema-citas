<?php

namespace App\Http\Livewire\Catalogue\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Catalogue\TypeExam;

class TypeexamTable extends DataTableComponent
{
    protected $model = TypeExam::class;
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'exams' => '$refresh'
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
                        'components.catalogue.typeexam-component',
                        [
                            $action = TypeExam::where('id', $row->id)->get(),
                            'name' => $action[0]->name,
                            'typexamsId' => $action[0]->id,
                        ]
                    )
                ),
        ];
    }
}
