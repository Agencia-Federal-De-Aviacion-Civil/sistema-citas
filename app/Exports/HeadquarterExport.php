<?php

namespace App\Exports;

use App\Models\Catalogue\Headquarter;
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

class HeadquarterExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting, WithStyles
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
            'rowNumber' => $this->rowNumber++,
            ($results->headquarterUser ?? null) ? $results->headquarterUser->name : 'SIN INFORMACIÓN',
            ($results->headquarterUser ?? null) ? $results->headquarterUser->email : 'SIN INFORMACIÓN',
            ($results->direction ?? null) ? $results->direction : 'SIN INFORMACIÓN',
            ($results->url ?? null) ? $results->url : 'SIN INFORMACIÓN',

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
            'SEDE',
            'CORREO',
            'DIRECCIÓN',
            'URL',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->setTitle('Headquarter');
        $sheet->getStyle('A1:E1')->applyFromArray([
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
