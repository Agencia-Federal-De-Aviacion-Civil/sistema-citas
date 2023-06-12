<?php

namespace App\Http\Livewire\Medicine\Tables;

use App\Events\Medicine\ExportCompleted;
use App\Jobs\ExportSelectedJob;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Bus;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use WireUi\Traits\Actions;

class AppointmentTable extends DataTableComponent
{
    use Actions;
    public $batchId;
    public $exporting;
    public $exportFinished;
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

            Column::make("Nombre", "medicineReserveFromUser.name")
                ->sortable()
                ->searchable(fn ($query, $searchTerm) => $query->orWhere('name', 'like', '%' . $searchTerm . '%')),

            Column::make("SEDE", "user.userHeadquarter.name")
                ->sortable(),
            Column::make("Apellido Paterno", "userParticipantUser.apParental")
                ->sortable(),

            Column::make("Apellido Materno", "userParticipantUser.apMaternal")
                ->sortable(),

            Column::make("Tipo", "medicineReserveMedicine.medicineTypeExam.name")
                ->sortable(),
            Column::make("FECHA", "dateReserve")
                ->sortable()
                ->searchable(),

            Column::make("HORA", "medicineSchedule.time_start")
                ->sortable(),

            Column::make("CURP", "userParticipantUser.curp")
                ->sortable(),

            Column::make("LLAVE DE PAGO", "medicineReserveMedicine.reference_number")
                ->sortable(),
            Column::make("Fecha de creación", "created_at")
                ->sortable(),
        ];
    }
    public function builder(): Builder
    {
        return MedicineReserve::query();
    }

    public function exportSelected()
    {
        if ($this->getSelected()) {
            $query = MedicineReserve::with([
                'medicineReserveMedicine', 'medicineReserveFromUser', 'user', 'userParticipantUser'
            ])->whereIn('id', $this->getSelected());
            $results = $query->get();
            $this->exporting = true;
            $this->exportFinished = false;
            $batch = Bus::batch([
                new ExportSelectedJob($results),
            ])->dispatch();
            $this->batchId = $batch->id;
            $this->emit('BatchDispatch', [$this->batchId, $this->exporting, $this->exportFinished]);
        } else {
        }
    }
}
