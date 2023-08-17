<?php

namespace App\Http\Livewire\Medicine\CertificateQr\Tables;

use App\Models\Medicine\CertificateQr\MedicineCertificateQr;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class HistoryCertificateQrTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("CURP", "certificateQrMedicineReserve.medicineReserveFromUser.UserPart.curp")
                ->searchable()
                ->sortable(),
            Column::make("TIPO", "certificateQrMedicineReserve.medicineReserveMedicine.medicineTypeExam.name")
                ->sortable(),
            Column::make("MEDICO", "medical_name")
                ->sortable(),
            Column::make("RESULTADO", "evaluation_result")
                ->sortable(),
            Column::make("EXPIRACIÓN", "date_expire")
                ->sortable(),
            ButtonGroupColumn::make('ACCIONES', 'id')
                ->buttons([
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                        ->title(fn ($row) => 'CERTIFICADO')
                        ->location(fn ($row) => route('afac.certificateGenerate', $row->id))
                        ->attributes(function ($row) {
                            return [
                                'target' => '_blank',
                                'class' => 'text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-xs px-2 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800"',
                            ];
                        }),
                ])
        ];
    }
    public function builder(): Builder
    {
        return MedicineCertificateQr::query()
            ->with('certificateQrMedicineReserve');
    }
}
