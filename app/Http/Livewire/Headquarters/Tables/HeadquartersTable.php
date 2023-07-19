<?php

namespace App\Http\Livewire\Headquarters\Tables;

use App\Exports\HeadquarterExport;
use App\Models\Catalogue\Headquarter;
use App\Models\UserHeadquarter;
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
            Column::make('SEDE', 'name_headquarter')
                ->searchable(fn ($query, $searchTerm) => $query->orWhere('users.name', 'like', '%' . $searchTerm . '%'))
                ->sortable(),
            // Column::make('CORREO', 'headquarterUser.id'),
            Column::make('DIRECCIÓN', 'direction'),
            Column::make('URL', 'url'),
            Column::make("ACCIÓN", 'id')
                ->format(
                    fn ($value) => view(
                        'components.edit-headquarter',
                        [
                            $userHeadquarters = UserHeadquarter::where('headquarter_id', $value)->get(),
                            'userId' => $value,
                            'userHeadquarters' => $userHeadquarters
                        ]
                    )
                ),
        ];
    }
    public function builder(): Builder
    {
        return Headquarter::query()->where('headquarters.status', '=', '0');
    }
    public function exportSelected()
    {

        if ($this->getSelected()) {

            $result = Headquarter::whereIn('id', $this->getSelected())->get();

            return Excel::download(new HeadquarterExport($result), 'headquarter.xlsx');
        }
    }
}
