<?php

namespace App\Http\Livewire\Medicine\Tables;

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
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),

            Column::make("Nombre", "userParticipantUser.name")
                ->sortable()
                ->searchable(fn ($query, $searchTerm) => $query->orWhere('name', 'like', '%' . $searchTerm . '%')),

            Column::make("Apellido Paterno", "apParental")
                ->sortable(),

            Column::make("Apellido Materno", "apMaternal")
                ->sortable(),

            Column::make("Acción", "userParticipantUser.userHistory.action")
                ->sortable(),

            Column::make("Proceso", "userParticipantUser.userHistory.process")
                ->sortable(),
            Column::make("Creo", "userParticipantUser.userHistory.created_at")
                ->sortable(),
            Column::make("Actualizo", "userParticipantUser.userHistory.updated_at")
                ->sortable(),
        ];
    }
    public function builder(): Builder
    {
        return UserParticipant::with('userParticipantUser');
    }
}
