<?php

namespace App\Http\Livewire\Medicine\Tables;

use App\Models\Medicine\medicine_history_movements;
use App\Models\UserParticipant;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use WireUi\Traits\Actions;

class HistoryMedicieTable extends DataTableComponent
{

    use Actions;
    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setBulkActions([
            'exportSelected' => 'EXPORTAR'
        ]);
        $this->setOfflineIndicatorEnabled();
        $this->setEagerLoadAllRelationsEnabled();
        $this->setDefaultSort('id','asc');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),

            Column::make("Nombre", "historyUser.name")
                ->sortable()
                ->searchable(fn ($query, $searchTerm) => $query->orWhere('name', 'like', '%' . $searchTerm . '%')),

            Column::make("Apellido Paterno", "historyUser.UserPart.apParental")
                ->sortable(),

            Column::make("Apellido Materno", "historyUser.UserPart.apMaternal")
                ->sortable(),

            Column::make("Acción", "action")
                ->sortable(),

            Column::make("Proceso", "process")
                ->sortable(),
            Column::make("Creo", "created_at")
                ->sortable(),
            Column::make("Actualizo", "updated_at")
                ->sortable(),
        ];
    }
    public function builder(): Builder
    {
        return medicine_history_movements::with('historyUser');
    }
}
