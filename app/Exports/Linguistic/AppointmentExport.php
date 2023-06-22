<?php

namespace App\Exports\Linguistic;

// use App\Models\LinguisticReserve;

use App\Models\Linguistic\LinguisticReserve;
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

// class AppointmentExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting, WithStyles, WithCustomQuerySize
class AppointmentExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting, WithStyles, WithCustomQuerySize
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
        return $this->results;
    }

    public function map($results): array
    {

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
            ($results->linguisticReserveFromUser ?? null) ? $results->linguisticReserveFromUser->name : 'SIN INFORMACIÓN',
            ($results->linguisticReserveFromUser->UserPart ?? null) ? $results->linguisticReserveFromUser->UserPart->apParental : 'SIN INFORMACIÓN',
            ($results->linguisticReserveFromUser->UserPart ?? null) ? $results->linguisticReserveFromUser->UserPart->apMaternal : 'SIN INFORMACIÓN',
            ($results->linguisticReserve->linguisticTypeExam->name ?? null) ? $results->linguisticReserve->linguisticTypeExam->name : 'SIN INFORMACIÓN',
            ($results->linguisticReserve->linguisticTypeLicense->name ?? null) ? $results->linguisticReserve->linguisticTypeLicense->name : 'SIN INFORMACIÓN',
            ($results->linguisticReserve->license_number ?? null) ? $results->linguisticReserve->license_number : 'SIN INFORMACIÓN',
            ($results->linguisticReserve->red_number ?? null) ? $results->linguisticReserve->red_number : 'SIN INFORMACIÓN',
            ($results->linguisticUserHeadquers->name ?? null) ? $results->linguisticUserHeadquers->name : 'SIN INFORMACIÓN',
            ($results->date_reserve ?? null) ? Carbon::parse($results->date_reserve)->format('d/m/y') : 'SIN INFORMACIÓN',
            ($results->linguisticReserveSchedule->time_start ?? null) ? $results->linguisticReserveSchedule->time_start : 'SIN INFORMACIÓN',
            ($results->linguisticReserveFromUser->UserPart->curp ?? null) ? $results->linguisticReserveFromUser->UserPart->curp : 'SIN INFORMACIÓN',
            ($results->linguisticReserve->reference_number ?? null) ? $results->linguisticReserve->reference_number : 'SIN INFORMACIÓN',
            ($results->linguisticReserveFromUser->UserPart->genre ?? null) ? $results->linguisticReserveFromUser->UserPart->genre : 'SIN INFORMACIÓN',
            ($results->linguisticReserveFromUser->UserPart->birth ?? null) ? Carbon::parse($results->linguisticReserveFromUser->UserPart->birth)->format('d/m/y') : 'SIN INFORMACIÓN',
            ($results->linguisticReserveFromUser->UserPart->participantState->name ?? null) ? $results->linguisticReserveFromUser->UserPart->participantState->name : 'SIN INFORMACIÓN',
            ($results->linguisticReserveFromUser->UserPart->age ?? null) ? $results->linguisticReserveFromUser->UserPart->age : 'SIN INFORMACIÓN',
            ($results->linguisticReserveFromUser->UserPart->mobilePhone ?? null) ? $results->linguisticReserveFromUser->UserPart->mobilePhone : 'SIN INFORMACIÓN',
            ($results->linguisticReserveFromUser->UserPart->officePhone ?? null) ? $results->linguisticReserveFromUser->UserPart->officePhone : 'SIN INFORMACIÓN',
            ($results->linguisticReserveFromUser->UserPart->extension ?? null) ? $results->linguisticReserveFromUser->UserPart->extension : 'SIN INFORMACIÓN',
            $status,
        ];
    }
    public function columnFormats(): array
    {
        return [
            'L' => NumberFormat::FORMAT_TEXT,
            'J' => 'dd/mm/yyyy',
            'O' => 'dd/mm/yyyy',
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
            'TIPO DE LICENCIA',
            'NÚMERO DE LICENCIA',
            'NÚMERO ROJO',
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
        $sheet->setTitle('Lingüística');
        $sheet->getStyle('A1:U1')->applyFromArray([
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
        return 1000; // Ajusta el tamaño de consulta según tus necesidades
    }
}
