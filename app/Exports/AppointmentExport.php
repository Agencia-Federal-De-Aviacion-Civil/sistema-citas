<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomQuerySize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AppointmentExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting, WithStyles, WithCustomQuerySize
{
    use Exportable;
    public $results;
    private $rowNumber = 1;
    public function __construct($results)
    {
        $this->results = $results;
    }
    public function collection()
    {
        return $this->results;
    }

    public function map($results): array
    {
        try {
            if ($results->medicineReserveMedicine->type_exam_id == 1) {
                $nameClass = ($results->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass ?? null) ? $results->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name : 'SIN INFORMACIÓN';
                $typeLicense = ($results->medicineReserveMedicine->medicineInitial[0]->medicineInitialClasificationClass ?? null) ? $results->medicineReserveMedicine->medicineInitial[0]->medicineInitialClasificationClass->name : 'SIN INFORMACIÓN';
            } else if ($results->medicineReserveMedicine->type_exam_id == 2) {
                $nameClass = ($results->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass ?? null) ? $results->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name : 'SIN INFORMACIÓN';
                $typeLicense = ($results->medicineReserveMedicine->medicineRenovation[0]->renovationClasificationClass ?? null) ? $results->medicineReserveMedicine->medicineRenovation[0]->renovationClasificationClass->name : 'SIN INFORMACIÓN';
            } else if ($results->medicineReserveMedicine->type_exam_id == 3) {
                $nameClass = $results->medicineReserveMedicine->medicineRevaluation[0]->type_exam_id == 1 ?  $results->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->revaluationInitialTypeClass->name : $results->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineRenovation[0]->revaluationRenovationTypeClass->name;
                if ($results->medicineReserveMedicine->medicineRevaluation[0]->type_exam_id == 1) {
                    $typeLicense = ($results->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->revaluationInitialClasificationClass ?? null) ? $results->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->revaluationInitialClasificationClass->name : 'SIN INFORMACIÓN';
                } else {
                    $typeLicense = ($results->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineRenovation[0]->revaluationRenovationClasificationClass ?? null) ? $results->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineRenovation[0]->revaluationRenovationClasificationClass->name : 'SIN INFORMACIÓN';
                }
            } else {
                $nameClass = ($results->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass ?? null) ? $results->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name : 'SIN INFORMACIÓN';
                $typeLicense = ($results->medicineReserveMedicine->medicineRenovation[0]->renovationClasificationClass ?? null) ? $results->medicineReserveMedicine->medicineRenovation[0]->renovationClasificationClass->name : 'SIN INFORMACIÓN';
            }
        } catch (\Exception $e) {
            echo $e;
        }
        if ($results->status === 1) {
            $status = 'ASISTIO';
        } else if ($results->status === 2) {
            $status = 'CANCELADO';
        } else if ($results->status === 3) {
            $status = 'CANCELO USUARIO';
        } else if ($results->status === 4) {
            $status = 'REAGENDO';
        } else if ($results->status === 5) {
            $status = 'LIBERADA';
        } else if ($results->status === 6) {
            $status = 'INCOMPLETAS';
        } else if ($results->status === 7) {
            $status = 'EXPIRO';
        } else if ($results->status === 8) {
            $status = 'CONCLUYÓ APTO';
        } else if ($results->status === 9) {
            $status = 'CONCLUYÓ NO APTO';
        } else if ($results->status === 10) {
            $status = 'REAGENDÓ';
        }else {
            $status = 'PENDIENTE';
        }
        return [
            'rowNumber' => $this->rowNumber++,
            ($results->medicineReserveMedicine ?? null) ? $results->medicineReserveFromUser->name : 'SIN INFORMACIÓN',
            ($results->userParticipantUser ?? null) ? $results->userParticipantUser->apParental : 'SIN INFORMACIÓN',
            ($results->userParticipantUser ?? null) ? $results->userParticipantUser->apMaternal : 'SIN INFORMACIÓN',
            ($results->medicineReserveMedicine->medicineTypeExam ?? null) ? $results->medicineReserveMedicine->medicineTypeExam->name : 'SIN INFORMACIÓN',
            $nameClass,
            $typeLicense,
            ($results->medicineReserveHeadquarter->name_headquarter ?? null) ? $results->medicineReserveHeadquarter->name_headquarter : 'SIN INFORMACIÓN',
            ($results->dateReserve ?? null) ? Carbon::parse($results->dateReserve)->format('d/m/Y') : 'SIN INFORMACIÓN',
            ($results->reserveSchedule ?? null) ? $results->reserveSchedule->time_start : 'SIN INFORMACIÓN',
            ($results->userParticipantUser ?? null) ? $results->userParticipantUser->curp : 'SIN INFORMACIÓN',
            ($results->medicineReserveMedicine ?? null) ? $results->medicineReserveMedicine->reference_number : 'SIN INFORMACIÓN',
            ($results->userParticipantUser ?? null) ? $results->userParticipantUser->genre : 'SIN INFORMACIÓN',
            ($results->userParticipantUser->birth ?? null) ? Carbon::parse($results->userParticipantUser->birth)->format('d/m/Y') : 'SIN INFORMACIÓN',
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
            'ESTADO NACIMIENTO',
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
    public function querySize(): int
    {
        return 1000;
    }
}
