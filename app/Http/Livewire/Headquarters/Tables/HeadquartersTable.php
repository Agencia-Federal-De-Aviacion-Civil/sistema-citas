<?php

namespace App\Http\Livewire\Headquarters\Tables;

use App\Exports\HeadquarterExport;
use App\Models\Catalogue\Headquarter;
use App\Models\UserHeadquarter;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

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
                ->searchable()
                ->sortable(),
            // Column::make('CORREO', 'headquarterUser.id'),
            Column::make('DIRECCIÓN', 'direction'),
            //Column::make('URL', 'url'),
            Column::make('ESTADO', 'state')
                ->searchable()
                ->sortable(),
            Column::make('TIPO', 'is_external')
                ->format(
                    fn ($value, $row, Column $column) => $row->is_external == 0 ? 'AFAC' : 'TERCEROS'
                )
                ->searchable()
                ->sortable(),
            Column::make('ESTATUS', 'status')
                ->format(
                    fn ($value, $row, Column $column) => $row->status == 0 ? '<span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">' . 'HABILITADA' . '</span>' : '<span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800">' . 'DESHABILITADA' . '</span>'
                )
                ->html()
                ->searchable()
                ->sortable(),
            Column::make("ACCIÓN", 'id')
                ->format(
                    fn ($value) => view(
                        'components.headquarters.edit-headquarter',
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
        return Headquarter::query();
    }
    public function filters(): array
    {
        return [
            SelectFilter::make('TIPO')
                ->options([
                    '' => 'TODOS',
                    '0' => 'AFAC',
                    '1' => 'TERCEROS'
                ])
                ->filter(function ($query, $value) {
                    $query->where('is_external', $value);
                }),

            SelectFilter::make('STATUS')
                ->options([
                    '' => 'TODOS',
                    '0' => 'HABILITADA',
                    '1' => 'DESHABILITADA'
                ])
                ->filter(function ($query, $value) {
                    $query->where('status', $value);
                }),
            SelectFilter::make('SISTEMA')
                ->options([
                    '' => 'TODOS',
                    '1' => 'MEDICINA',
                    '2' => 'LINGÜISTICA'
                ])
                ->filter(function ($query, $value) {
                    $query->where('system_id', $value);
                }),

        ];
    }
    public function exportSelected()
    {

        if ($this->getSelected()) {

            $result = Headquarter::whereIn('id', $this->getSelected())->get();

            return Excel::download(new HeadquarterExport($result), 'headquarter.xlsx');
        }
    }
}
