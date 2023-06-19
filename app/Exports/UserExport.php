<?php

namespace App\Exports;

use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting, WithStyles
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
    /**
    * @return \Illuminate\Support\Collection
    */
    public function map($results): array
    {
        return [
            $results->id,
            ($results->name ?? null) ? $results->name : 'SIN INFORMACIÓN',
            ($results->UserPart ?? null) ? $results->UserPart->apParental : 'SIN INFORMACIÓN',
            ($results->UserPart ?? null) ? $results->UserPart->apMaternal : 'SIN INFORMACIÓN',
            ($results->email),
            ($results->UserPart->curp ?? null) ? $results->UserPart->curp : 'SIN REUSLTADO',
            ($results->UserPart->genre ?? null) ? $results->UserPart->genre : 'SIN REUSLTADO',

            ($results->UserPart->birth ?? null) ? Carbon::parse($results->UserPart->birth)->format('d/m/Y') : 'SIN INFORMACIÓN',

            ($results->UserPart->age ?? null) ? $results->UserPart->age : 'SIN REUSLTADO',
            ($results->UserPart->participantState ?? null) ? $results->UserPart->participantState->name : 'SIN REUSLTADO',
            ($results->UserPart->participantMunicipal ?? null) ? $results->UserPart->participantMunicipal->name : 'SIN REUSLTADO',
            ($results->UserPart->street ?? null) ? $results->UserPart->street : 'SIN REUSLTADO',
            ($results->UserPart->nInterior ?? null) ? $results->UserPart->nInterior : 'SIN REUSLTADO',
            ($results->UserPart->nExterior ?? null) ? $results->UserPart->nExterior : 'SIN REUSLTADO',
            ($results->UserPart->suburb ?? null) ? $results->UserPart->suburb : 'SIN REUSLTADO',
            ($results->UserPart->postalCode ?? null) ? $results->UserPart->postalCode : 'SIN REUSLTADO',
            ($results->UserPart->federalEntity ?? null) ? $results->UserPart->federalEntity : 'SIN REUSLTADO',
            ($results->UserPart->delegation ?? null) ? $results->UserPart->delegation : 'SIN REUSLTADO',
            ($results->UserPart->mobilePhone ?? null) ? $results->UserPart->mobilePhone : 'SIN REUSLTADO',
            ($results->UserPart->officePhone ?? null) ? $results->UserPart->officePhone : 'SIN REUSLTADO',
            ($results->UserPart->extension ?? null) ? $results->UserPart->extension : 'SIN REUSLTADO',
            ($results->roles[0]->name ?? null) ? $results->roles[0]->name : 'SIN INFORMACIÓN',
        ];
    }
    public function columnFormats(): array
    {
        return [
            'K' => NumberFormat::FORMAT_TEXT,
            'L' => NumberFormat::FORMAT_TEXT,
            'H' => 'dd/mm/yyyy',
        ];
    }
    public function headings(): array
    {
        return [
            '#Item',
            'NOMBRE',
            'APELLIDO PATERNO',
            'APELLIDO MATERNO',
            'CORREO',
            'CURP',
            'GENERO',
            'FECHA NACIMIENTO',
            'EDAD',
            'ESTADO',
            'MUNICIPIO',
            'CALLE',
            'N° INTERIRO',
            'N° EXTERIRO',
            'COLONIA',
            'CODIGO POSTAL',
            'ENTIDAD',
            'DELEGACIÓN',
            'CELULAR',
            'OFICINA',
            'EXTENSIÓN',
            'ROL',

        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->setTitle('Citas');
        $sheet->getStyle('A1:V1')->applyFromArray([
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
