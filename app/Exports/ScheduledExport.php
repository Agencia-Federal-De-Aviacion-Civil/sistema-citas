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
    public $medreser;
    private $rowNumber = 1;

    public function __construct($medreser)
    {
        $this->medreser = $medreser;
    }

    public function collection()
    {
        return $this->medreser;
    }
    public function map($medreser): array
    {

        if ($medreser->medicineReserveMedicine->medicineTypeExam->id == 1) {
            $nameClass = ($medreser->medicineReserveMedicine->medicineInitialExc->medicineInitialTypeClass ?? null) ? $medreser->medicineReserveMedicine->medicineInitialExc->medicineInitialTypeClass->name : 'SIN INFORMACIÓN';
            $typeLicense = ($medreser->medicineReserveMedicine->medicineInitialExc->medicineInitialClasificationClass ?? null) ? $medreser->medicineReserveMedicine->medicineInitialExc->medicineInitialClasificationClass->name : 'SIN INFORMACIÓN';
        } else if ($medreser->medicineReserveMedicine->medicineTypeExam->id == 2) {
            $nameClass = ($medreser->medicineReserveMedicine->medicineRenovationExc->renovationTypeClass ?? null) ? $medreser->medicineReserveMedicine->medicineRenovationExc->renovationTypeClass->name : 'SIN INFORMACIÓN';
            $typeLicense = ($medreser->medicineReserveMedicine->medicineRenovationExc->renovationClasificationClass ?? null) ? $medreser->medicineReserveMedicine->medicineRenovationExc->renovationClasificationClass->name : 'SIN INFORMACIÓN';
        }
        // if ($medreser->medicineReserveMedicine->medicineTypeExam->id == 1) {
        //     $typeLicense = '2';
        // } else if ($medreser->medicineReserveMedicine->medicineTypeExam->id == 2) {
        //     $typeLicense = '2';
        // }
        // $typeLicense = '2';
        if ($medreser->status == 1) {
            $status = 'ASISTIO';
        } else if ($medreser->status == 2) {
            $status = 'CANCELADO';
        } else if ($medreser->status == 3) {
            $status = 'CANCELO USUARIO';
        } else if ($medreser->status == 4) {
            $status = 'REAGENDO';
        } else {
            $status = 'PENDIENTE';
        }


        return [
            'rowNumber' => $this->rowNumber++,
            ($medreser->medicineReserveFromUser ?? null) ? $medreser->medicineReserveFromUser->name : 'SIN INFORMACIÓN',
            ($medreser->userParticipantUser ?? null) ? $medreser->userParticipantUser->apParental : 'SIN INFORMACIÓN',
            ($medreser->userParticipantUser ?? null) ? $medreser->userParticipantUser->apMaternal : 'SIN INFORMACIÓN',
            ($medreser->medicineReserveMedicine->medicineTypeExam ?? null) ? $medreser->medicineReserveMedicine->medicineTypeExam->name : 'SIN INFORMACIÓN',
            $nameClass,
            $typeLicense,
            ($medreser->user->name ?? null) ? $medreser->user->name : 'SIN INFORMACIÓN',
            Carbon::parse($medreser->dateReserve)->format('d/m/Y'),
            ($medreser->reserveSchedule ? $medreser->reserveSchedule->time_start : 'SIN INFORMACIÓN'),
            ($medreser->userParticipantUser ? $medreser->userParticipantUser->curp : 'SIN INFORMACIÓN'),
            ($medreser->medicineReserveMedicine ?? null) ? $medreser->medicineReserveMedicine->reference_number : 'SIN INFORMACIÓN',
            ($medreser->userParticipantUser ?? null) ? $medreser->userParticipantUser->genre : 'SIN INFORMACIÓN',
            Carbon::parse($medreser->userParticipantUser ? $medreser->userParticipantUser->birth : '')->format('d/m/Y'),
            ($medreser->userParticipantUser->participantState ?? null) ? $medreser->userParticipantUser->participantState->name : 'SIN INFORMACIÓN',
            ($medreser->userParticipantUser ?? null) ? $medreser->userParticipantUser->age : 'SIN INFORMACIÓN',
            ($medreser->userParticipantUser ?? null) ? $medreser->userParticipantUser->mobilePhone : 'SIN INFORMACIÓN',
            ($medreser->userParticipantUser ?? null) ? $medreser->userParticipantUser->officePhone : 'SIN INFORMACIÓN',
            ($medreser->userParticipantUser ?? null) ? $medreser->userParticipantUser->extension : 'SIN INFORMACIÓN',
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
