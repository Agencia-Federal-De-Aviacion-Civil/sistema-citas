<?php

namespace App\Exports;

use App\Models\Medicine\MedicineReserve as MedicineMedicineReserve;
use App\Models\MedicineReserve;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\DefaultValueBinder;

class ScheduledExport extends DefaultValueBinder implements FromQuery,WithMapping,WithHeadings
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    use Exportable;
    public $medreser;
    private $rowNumber = 1;

    public function __construct($medreser)
    {
        $this->medreser = $medreser;
    }

    // public function collection()
    // {
    //     return $this->medreser;
    // }

    public function query()
    {

        //  dd($this->medreser);
        // return $this->medreser;

        return MedicineMedicineReserve::all();

        // return AirportComplementaryMoral::with([
        //     'complementaryMoral.promoterUser', 'complementaryMoralAirport',
        // ])
        //     ->whereHas('complementaryMoral.promoterUser', function ($q1) {
        //         $q1->where('user_id', Auth()->user()->id);
        //     });

    }
    public function map($row): array
    {
        return [
            'rowNumber' => $this->rowNumber++,
            // $row->userParticipantUser[0]->name,

        ];
    }

    public function headings(): array
    {
     return [
         '#Item',
        //  'nombre',
     ];
    }

}
