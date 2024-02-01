<?php

namespace App\Http\Livewire\Medicine\MedicineAfac;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use Livewire\Component;

class HomeMedicineAfac extends Component
{
    public $id_dashboard, $date1, $date2;
    public $appointmentNow, $nowDate, $registerCount, $porConfirDashboard, $penDashboard, $porPenDashboard, $cancelDashboard, $reagDashboard,
        $porReagDashboard, $porCancelDashboard, $validateDashboard, $apto, $porApto, $noApto, $porNoApto, $aplazadas, $porAplazada;
    public function mount($id_dashboard, $date1, $date2)
    {
        $this->date1 = $date1;
        $this->date2 = $date2;
        $appointmentDashboard = MedicineReserve::query()
            ->select('status', DB::raw('count(*) as count'), 'dateReserve')
            ->groupBy('status', 'dateReserve')
            ->when($id_dashboard == 0, function ($appointmentDashboard) {
                $appointmentDashboard->where('is_external', false);
            })
            ->when($id_dashboard == 1, function ($appointmentDashboard) {
                $appointmentDashboard->where('is_external', true);
            })
            ->get();
        $this->appointmentNow = $appointmentDashboard->where('dateReserve', $date1);
        $this->nowDate = $id_dashboard == 0 ? $this->appointmentNow->whereIn('status', ['0', '1', '4'])->sum('count') : $this->appointmentNow->whereIn('status', ['0', '1', '4', '10', '7', '8', '9'])->sum('count');
        $this->registerCount =  $appointmentDashboard->sum('count');
        $this->porConfirDashboard = $this->registerCount != 0 ? round($appointmentDashboard->where('status', '1')->sum('count') * 100 / $this->registerCount, 0) : 0;
        $this->validateDashboard = $appointmentDashboard->where('status', '1')->sum('count');
        $this->penDashboard = $appointmentDashboard->where('status', '0')->sum('count');
        $this->porPenDashboard = $this->registerCount != 0 ? round($appointmentDashboard->where('status', '0')->sum('count') * 100 / $this->registerCount, 0) : 0;
        $this->cancelDashboard = $appointmentDashboard->whereIn('status', ['2', '3', '5'])->sum('count');
        $this->reagDashboard = $id_dashboard == 0 ? round($appointmentDashboard->where('status', '4')->sum('count')) :  round($appointmentDashboard->whereIn('status', ['4', '10'])->sum('count'));
        $this->porReagDashboard = $id_dashboard == 0 ? ($this->registerCount != 0 ? round($appointmentDashboard->where('status', '4')->sum('count') * 100 / $this->registerCount) : 0) : ($this->registerCount != 0 ? round($appointmentDashboard->whereIn('status', ['4', '10'])->sum('count') * 100 / $this->registerCount) : 0);
        $this->porCancelDashboard = $this->registerCount != 0 ? round($appointmentDashboard->whereIn('status', ['2', '3', '5'])->sum('count') * 100 / $this->registerCount, 0) : 0;
        $this->apto = $appointmentDashboard->where('status', '8')->sum('count');
        $this->porApto = $this->registerCount != 0 ? round($appointmentDashboard->where('status', '8')->sum('count') * 100 / $this->registerCount, 0) : 0;
        $this->noApto = $appointmentDashboard->where('status', '9')->sum('count');
        $this->porNoApto = $this->registerCount != 0 ? round($appointmentDashboard->where('status', '9')->sum('count') * 100 / $this->registerCount, 0) : 0;
        $this->aplazadas = $appointmentDashboard->where('status', '7')->sum('count');
        $this->porAplazada = $this->registerCount != 0 ? round($appointmentDashboard->where('status', '7')->sum('count') * 100 / $this->registerCount, 0) : 0;
    }
    public function render()
    {
        Date::setLocale('es');
        // $datenowDate = Date::now()->format('l j F Y');
        // $date_afac1 = Date::now()->format('l j F Y');
        $date1_afac1 = Date::now()->format('Y-m-d');
        $date2_afac1 = Date::now()->format('d-m-Y');
        // $tomorrow_afac1 = Date::tomorrow()->format('Y-m-d');

        $nameHeadquarter_afac1 = '';
        if (Auth::user()->can('headquarters.see.dashboard')) {
            $appointmentDashboard = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                    $q1->where('user_id', Auth::user()->id);
                })
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->get();
            // $headquarters_afac1 = Headquarter::with([
            //     'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
            // ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
            //     $q2->where('user_id', Auth::user()->id);
            // })->get();
            // $nameHeadquarter_afac1 = $headquarters_afac1->pluck('name_headquarter')->first();
        } else if (Auth::user()->can('sub_headquarters.see.dashboard')) {
            $appointmentDashboard = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q3) {
                    $q3->where('user_id', Auth::user()->id);
                })
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->where('headquarter_id', 6)
                ->where('dateReserve', $date1_afac1)
                ->get();
            // $headquarters_afac1 = Headquarter::with([
            //     'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
            // ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
            //     $q2->where('user_id', Auth::user()->id);
            // })->get();
        } else {
            // $headquarters_afac1 = Headquarter::with([
            //     'headquarterMedicineReserve'
            // ])->where('is_external', false)->get();
        }
        return view('livewire.medicine.medicine-afac.home-medicine-afac');
    }
}
