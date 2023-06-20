<?php

namespace App\Http\Livewire\Headquarters\Tables;

use App\Exports\HeadquarterExport;
use App\Models\Catalogue\Headquarter;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class HeadquartersTable extends DataTableComponent
{
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'saveHeadquarter' => '$refresh',
            ]
        );
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setBulkActions([
            'exportSelected' => 'EXPORTAR'
        ]);
        $this->setPerPageAccepted([
            10, 20, 50, 100
        ]);
        $this->setOfflineIndicatorEnabled();
        $this->setEagerLoadAllRelationsEnabled();
        $this->setDefaultSort('id', 'asc');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make('SEDE', 'headquarterUser.name')
                ->searchable(fn ($query, $searchTerm) => $query->orWhere('users.name', 'like', '%' . $searchTerm . '%'))
                ->sortable(),
            Column::make('CORREO', 'headquarterUser.email'),
            Column::make('DIRECCIÓN', 'direction'),
            Column::make('URL', 'url'),
            Column::make("ACCIÓN")
                ->label(
                    fn ($row) => view(
                        'components.edit-headquarter',
                        [
                            $userId = Headquarter::where('id', $row->id)->get(),
                            'userId' => $userId[0]->user_id,
                        ]
                    )
                ),
        ];
    }
    public function builder(): Builder
    {
        return Headquarter::query()->with(['headquarterUser'])->where('headquarters.status','=','0');
    }
    public function exportSelected()
    {

        if ($this->getSelected()) {

            $result = Headquarter::whereIn('id', $this->getSelected())->get();

            return Excel::download(new HeadquarterExport($result), 'headquarter.xlsx');
        }
    }
}
