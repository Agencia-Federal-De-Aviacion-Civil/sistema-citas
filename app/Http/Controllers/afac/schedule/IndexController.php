<?php

namespace App\Http\Controllers\afac\schedule;

use App\Http\Controllers\Controller;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Jenssegers\Date\Date;
use PDF;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super_admin|user|medicine_admin|headquarters']);
    }
    public function index()
    {
        return view('afac.schedule.index');
    }
    public function download($scheduleId)
    {
        Date::setLocale('es');
        $medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])
            ->where('medicine_id', $scheduleId)->get();
        $medicineId =  Crypt::encryptString($medicineReserves[0]->medicine_id);
        $medicineIdFree =  $medicineReserves[0]->medicine_id;
        $dateAppointment = $medicineReserves[0]->dateReserve;
        $dateConvertedFormatted = Date::parse($dateAppointment)->format('l j F Y');
        $curp = $medicineReserves[0]->medicineReserveMedicine->medicineUser->userParticipant->pluck('curp')->first();
        // $keyEncrypt =  Crypt::encryptString($medicineId . '*' . $dateAppointment . '*' . $curp);
        $fileName = $medicineReserves[0]->dateReserve . '-' . $curp . '-' . 'MED-' . $medicineIdFree . '.pdf';
        if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 1) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-initial', compact('medicineReserves', 'dateConvertedFormatted', 'medicineId'));
            return $pdf->download($fileName);
        } else if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 2) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-renovation', compact('medicineReserves', 'dateConvertedFormatted', 'medicineId'));
            return $pdf->download($fileName);
        }
    }
}
