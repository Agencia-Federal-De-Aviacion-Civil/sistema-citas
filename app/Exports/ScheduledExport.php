<?php

namespace App\Exports;

use Carbon\Carbon;
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
    public $query;
    private $rowNumber = 1;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function collection()
    {
        return $this->query;
    }
    public function map($query): array
    {

        if ($query->medicineReserveMedicine->medicineTypeExam->id == 1) {
            $nameClass = ($query->medicineReserveMedicine->medicineInitialExc->medicineInitialTypeClass ?? null) ? $query->medicineReserveMedicine->medicineInitialExc->medicineInitialTypeClass->name : 'SIN INFORMACIÓN';
            $typeLicense = ($query->medicineReserveMedicine->medicineInitialExc->medicineInitialClasificationClass ?? null) ? $query->medicineReserveMedicine->medicineInitialExc->medicineInitialClasificationClass->name : 'SIN INFORMACIÓN';
        } else if ($query->medicineReserveMedicine->medicineTypeExam->id == 2) {
            $nameClass = ($query->medicineReserveMedicine->medicineRenovationExc->renovationTypeClass ?? null) ? $query->medicineReserveMedicine->medicineRenovationExc->renovationTypeClass->name : 'SIN INFORMACIÓN';
            $typeLicense = ($query->medicineReserveMedicine->medicineRenovationExc->renovationClasificationClass ?? null) ? $query->medicineReserveMedicine->medicineRenovationExc->renovationClasificationClass->name : 'SIN INFORMACIÓN';
        }
        if ($query->status == 1) {
            $status = 'ASISTIO';
        } else if ($query->status == 2) {
            $status = 'CANCELADO';
        } else if ($query->status == 3) {
            $status = 'CANCELO USUARIO';
        } else if ($query->status == 4) {
            $status = 'REAGENDO';
        } else {
            $status = 'PENDIENTE';
        }


        return [
            'rowNumber' => $this->rowNumber++,
            ($query->medicineReserveFromUser ?? null) ? $query->medicineReserveFromUser->name : 'SIN INFORMACIÓN',
            ($query->userParticipantUser ?? null) ? $query->userParticipantUser->apParental : 'SIN INFORMACIÓN',
            ($query->userParticipantUser ?? null) ? $query->userParticipantUser->apMaternal : 'SIN INFORMACIÓN',
            ($query->medicineReserveMedicine->medicineTypeExam ?? null) ? $query->medicineReserveMedicine->medicineTypeExam->name : 'SIN INFORMACIÓN',
            $nameClass,
            $typeLicense,
            ($query->user->name ?? null) ? $query->user->name : 'SIN INFORMACIÓN',
            Carbon::parse($query->dateReserve)->format('d/m/Y'),
            ($query->reserveSchedule ? $query->reserveSchedule->time_start : 'SIN INFORMACIÓN'),
            ($query->userParticipantUser ? $query->userParticipantUser->curp : 'SIN INFORMACIÓN'),
            ($query->medicineReserveMedicine ?? null) ? $query->medicineReserveMedicine->reference_number : 'SIN INFORMACIÓN',
            ($query->userParticipantUser ?? null) ? $query->userParticipantUser->genre : 'SIN INFORMACIÓN',
            Carbon::parse($query->userParticipantUser ? $query->userParticipantUser->birth : '')->format('d/m/Y'),
            ($query->userParticipantUser->participantState ?? null) ? $query->userParticipantUser->participantState->name : 'SIN INFORMACIÓN',
            ($query->userParticipantUser ?? null) ? $query->userParticipantUser->age : 'SIN INFORMACIÓN',
            ($query->userParticipantUser ?? null) ? $query->userParticipantUser->mobilePhone : 'SIN INFORMACIÓN',
            ($query->userParticipantUser ?? null) ? $query->userParticipantUser->officePhone : 'SIN INFORMACIÓN',
            ($query->userParticipantUser ?? null) ? $query->userParticipantUser->extension : 'SIN INFORMACIÓN',
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
