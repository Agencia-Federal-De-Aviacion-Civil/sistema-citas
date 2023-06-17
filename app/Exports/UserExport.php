<?php

namespace App\Exports;

use App\Models\User;
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
            $results->name
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
            'CORREO',
            'CURP',
            'GENERO',
            'FECHA NACIMIENTO',
            'ESTADO NACIMINETO',
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
