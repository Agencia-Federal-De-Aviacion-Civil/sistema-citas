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
            $nameClass = 'clase1';
            //$medreser->medicineReserveMedicine->medicineInitialExc->medicineInitialTypeClass->name;
            $typeLicense = 'licencia1';
            //$medreser->medicineReserveMedicine->medicineInitialExc->medicineInitialClasificationClass->name;
        } else if ($medreser->medicineReserveMedicine->medicineTypeExam->id == 2) {
            $nameClass = 'clase2';
            // $medreser->medicineReserveMedicine->medicineRenovationExc->renovationTypeClass->name;
            $typeLicense = 'licencia2';
            // $medreser->medicineReserveMedicine->medicineRenovationExc->renovationClasificationClass->name;
        }
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
            ($medreser->medicineReserveFromUser ? $medreser->medicineReserveFromUser->name : ''),
            ($medreser->userParticipantUser ? $medreser->userParticipantUser->apParental : ''),
            ($medreser->userParticipantUser ? $medreser->userParticipantUser->apMaternal : ''),
            ($medreser->medicineReserveMedicine->medicineTypeExam ? $medreser->medicineReserveMedicine->medicineTypeExam->name : ''),
            $nameClass,
            ($typeLicense ? $typeLicense : ''),
            ($medreser->user->name ? $medreser->user->name : ''),
            Carbon::parse($medreser->dateReserve)->format('d/m/Y'),
            ($medreser->reserveSchedule ? $medreser->reserveSchedule->time_start : ''),
            ($medreser->userParticipantUser ? $medreser->userParticipantUser->curp : ''),
            ($medreser->medicineReserveMedicine ? $medreser->medicineReserveMedicine->reference_number : ''),
            ($medreser->userParticipantUser ? $medreser->userParticipantUser->genre : ''),
            Carbon::parse($medreser->userParticipantUser->birth)->format('d/m/Y'),
            // ($medreser->userParticipantUser->participantState ? $medreser->userParticipantUser->participantState->name : ''),
            ($medreser->userParticipantUser ? $medreser->userParticipantUser->age : ''),
            ($medreser->userParticipantUser ? $medreser->userParticipantUser->mobilePhone : ''),
            ($medreser->userParticipantUser ? $medreser->userParticipantUser->officePhone : ''),
            ($medreser->userParticipantUser ? $medreser->userParticipantUser->extension : ''),
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
