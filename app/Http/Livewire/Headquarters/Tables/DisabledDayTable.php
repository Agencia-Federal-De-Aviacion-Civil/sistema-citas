<?php

namespace App\Http\Livewire\Headquarters\Tables;

use App\Models\Medicine\MedicineDisabledDays;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Facades\Auth;

class DisabledDayTable extends DataTableComponent
{

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'createOrUpdateSchedule' => '$refresh',
                'deleteSchedule' => '$refresh'
            ]
        );
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');

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
            Column::make('ID', 'id')
                ->sortable(),
            Column::make('SEDE', 'disabledDaysHeadquarter.name_headquarter')
                ->searchable(),
            // ->sortable(),
            // ->makeInputRange(),

            Column::make('FECHAS DESHABILITADAS', 'disabled_days')
                ->searchable()
                ->sortable(),
            Column::make("ACCIÓN")
                ->label(
                    fn ($row) => view(
                        'components.headquarters.disabled-days-component',
                        [
                            // $userId = Headquarter::where('id', $row->id)->get(),
                            'actionId' => $row->id,
                        ]
                    )
                ),
        ];
    }
    public function builder(): Builder
    {
        if (Auth::user()->can('headquarters_authorized.see.tabs.navigation')) {
            return (MedicineDisabledDays::query()->with([
                'disabledDaysHeadquarter','disabledDaysHeadquarter.HeadquarterUserHeadquarter'
            ])->whereHas('disabledDaysHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                $q1->where('user_id', Auth::user()->id);
            }));
        }else{
            return MedicineDisabledDays::query()->with('disabledDaysHeadquarter');
        }
    }
}
