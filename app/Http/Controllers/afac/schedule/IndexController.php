<?php

namespace App\Http\Controllers\afac\schedule;

use App\Http\Controllers\Controller;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use PDF;
class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super_admin|user']);
    }
    public function index()
    {
        return view('afac.schedule.index');
    }
    public function download($scheduleId)
    {
        $medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser', 'user'])
            ->where('medicine_id', $scheduleId)->get();
        $curpKey = $medicineReserves[0]->medicineReserveMedicine->medicineUser->userParticipant->pluck('id')->first();
        $keyEncrypt =  Crypt::encryptString($curpKey);
        if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 1) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-initial', compact('medicineReserves', 'keyEncrypt'));
            return $pdf->download($medicineReserves[0]->dateReserve . '-' . 'cita.pdf');
        } else if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 2) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-renovation', compact('medicineReserves', 'keyEncrypt'));
            return $pdf->download($medicineReserves[0]->dateReserve . '-' . 'cita.pdf');
        }
    }
}
