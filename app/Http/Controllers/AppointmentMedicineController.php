<?php

namespace App\Http\Controllers;

use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Facades\Crypt;
use Jenssegers\Date\Date;
use PDF;

class AppointmentMedicineController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super_admin|user|medicine_admin|sub_headquarters|headquarters|super_admin_medicine|admin_medicine_v2']);
    }
    public function index()
    {
        return view('afac.medicine.home-appointment');
    }
    public function download($scheduleId)
    {
        Date::setLocale('es');
        $medicineReserves = MedicineReserve::with(['medicineReserveMedicine', 'medicineReserveFromUser'])
            ->where('id', $scheduleId)->get();
        $medicineId = $medicineReserves[0]->id;
        $dateAppointment = $medicineReserves[0]->dateReserve;
        $dateConvertedFormatted = Date::parse($dateAppointment)->format('l j F Y');
        $curp = $medicineReserves[0]->medicineReserveMedicine->medicineUser->userParticipant->pluck('curp')->first();
        $keyEncrypt = Crypt::encryptString($medicineId . '*' . $dateAppointment . '*' . $curp);
        $idExternalInternal = boolval($medicineReserves[0]->is_external);
        if (!$idExternalInternal) {
            $fileName = $medicineReserves[0]->dateReserve . '-' . $curp . '-' . 'MED-' . $medicineId . '.pdf';
        } else {
            $fileName = $medicineReserves[0]->dateReserve . '-' . $curp . '-' . 'MED-EXT-' . $medicineId . '.pdf';
        }
        $thirdAppointment = MedicineReserve::where('headquarter_id', $medicineReserves[0]->headquarter_id)
            ->where('dateReserve', $medicineReserves[0]->dateReserve)
            ->where(function ($query) {
                $query->where('status', 0)
                    ->Orwhere('status', 1);
            })
            ->where(function ($query2) {
                $query2->where('is_external', true);
            })
            ->count();
        if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 1) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-initial', compact('medicineReserves', 'keyEncrypt', 'dateConvertedFormatted', 'idExternalInternal','thirdAppointment'));
            return $pdf->download($fileName);
        } else if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 2) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-renovation', compact('medicineReserves', 'keyEncrypt', 'dateConvertedFormatted', 'idExternalInternal','thirdAppointment'));
            return $pdf->download($fileName);
        } else if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 3) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-revaluation', compact('medicineReserves', 'keyEncrypt', 'dateConvertedFormatted'));
            return $pdf->download($fileName);
        } else if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 4) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-revaluation-accident', compact('medicineReserves', 'keyEncrypt', 'dateConvertedFormatted'));
            return $pdf->download($fileName);
        } else if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 5) {
            $pdf = PDF::loadView('livewire.medicine.documents.medicine-flexibility', compact('medicineReserves', 'keyEncrypt', 'dateConvertedFormatted'));
            return $pdf->download($fileName);
        }
    }
}
