<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ScheduledExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public $results;
    private $rowNumber = 1;

    public function __construct($results)
    {
        $this->results = $results;
    }

    public function collection()
    {
        return $this->results->flatten();
    }
    public function map($results): array
    {
        if ($results->medicineReserveMedicine->medicineTypeExam->id == 1) {
            $nameClass = ($results->medicineReserveMedicine->medicineInitialExc->medicineInitialTypeClass ?? null) ? $results->medicineReserveMedicine->medicineInitialExc->medicineInitialTypeClass->name : 'SIN INFORMACIÓN';
            $typeLicense = ($results->medicineReserveMedicine->medicineInitialExc->medicineInitialClasificationClass ?? null) ? $results->medicineReserveMedicine->medicineInitialExc->medicineInitialClasificationClass->name : 'SIN INFORMACIÓN';
        } else if ($results->medicineReserveMedicine->medicineTypeExam->id == 2) {
            $nameClass = ($results->medicineReserveMedicine->medicineRenovationExc->renovationTypeClass ?? null) ? $results->medicineReserveMedicine->medicineRenovationExc->renovationTypeClass->name : 'SIN INFORMACIÓN';
            $typeLicense = ($results->medicineReserveMedicine->medicineRenovationExc->renovationClasificationClass ?? null) ? $results->medicineReserveMedicine->medicineRenovationExc->renovationClasificationClass->name : 'SIN INFORMACIÓN';
        }
        if ($results->status == 1) {
            $status = 'ASISTIO';
        } else if ($results->status == 2) {
            $status = 'CANCELADO';
        } else if ($results->status == 3) {
            $status = 'CANCELO USUARIO';
        } else if ($results->status == 4) {
            $status = 'REAGENDO';
        } else {
            $status = 'PENDIENTE';
        }
        return [
            'rowNumber' => $this->rowNumber++,
            ($results->medicineReserveFromUser ?? null) ? $results->medicineReserveFromUser->name : 'SIN INFORMACIÓN',
            ($results->userParticipantUser ?? null) ? $results->userParticipantUser->apParental : 'SIN INFORMACIÓN',
            ($results->userParticipantUser ?? null) ? $results->userParticipantUser->apMaternal : 'SIN INFORMACIÓN',
            ($results->medicineReserveMedicine->medicineTypeExam ?? null) ? $results->medicineReserveMedicine->medicineTypeExam->name : 'SIN INFORMACIÓN',
            $nameClass,
            $typeLicense,
            ($results->user->name ?? null) ? $results->user->name : 'SIN INFORMACIÓN',
            Carbon::parse($results->dateReserve)->format('d/m/Y'),
            ($results->reserveSchedule ?? null) ? $results->reserveSchedule->time_start : 'SIN INFORMACIÓN',
            ($results->userParticipantUser ?? null) ? $results->userParticipantUser->curp : 'SIN INFORMACIÓN',
            ($results->medicineReserveMedicine ?? null) ? $results->medicineReserveMedicine->reference_number : 'SIN INFORMACIÓN',
            ($results->userParticipantUser ?? null) ? $results->userParticipantUser->genre : 'SIN INFORMACIÓN',
            Carbon::parse($results->userParticipantUser->birth)->format('d/m/Y'),
            ($results->userParticipantUser->participantState ?? null) ? $results->userParticipantUser->participantState->name : 'SIN INFORMACIÓN',
            ($results->userParticipantUser ?? null) ? $results->userParticipantUser->age : 'SIN INFORMACIÓN',
            ($results->userParticipantUser ?? null) ? $results->userParticipantUser->mobilePhone : 'SIN INFORMACIÓN',
            ($results->userParticipantUser ?? null) ? $results->userParticipantUser->officePhone : 'SIN INFORMACIÓN',
            ($results->userParticipantUser ?? null) ? $results->userParticipantUser->extension : 'SIN INFORMACIÓN',
            $status,

        ];
    }
    public function columnFormats(): array
    {
        return [
            'K' => NumberFormat::FORMAT_TEXT,
            'L' => NumberFormat::FORMAT_TEXT,
            'I' => 'dd/mm/yyyy',
            'N' => 'dd/mm/yyyy',
        ];
    }

    public function headings(): array
    {
        return [
            '#Item',
            'NOMBRE',
            'APELLIDO PATERNO',
            'APELLIDO MATERNO',
            'TIPO',
            'CLASE',
            'TIPO DE LICENCIA',
            'SEDE',
            'FECHA',
            'HORA',
            'CURP',
            'LLAVE PAGO',
            'GENERO',
            'FECHA NACIMIENTO',
            'ESTADO NACIMINETO',
            'EDAD',
            'CELULAR',
            'OFICINA',
            'EXTENSIÓN',
            'ESTADO'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->setTitle('Citas');
        $sheet->getStyle('A1:T1')->applyFromArray([
            'font' => [
                'bold' => true,
                // 'name' => 'Arial'
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => [
                    'argb' => 'DCDCDC'
                ]
            ]
        ]);
    }
}
