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
        $porReagDashboard, $porCancelDashboard, $validateDashboard, $apto, $porApto, $noApto, $porNoApto, $aplazadas, $porAplazada, $headquarterQueries,
        $tomorrow;
    public function mount($id_dashboard, $date1, $date2)
    {
        $this->date1 = $date1;
        $this->date2 = $date2;
        $this->tomorrow = Date::tomorrow()->format('Y-m-d');

        $appointmentDashboard = MedicineReserve::query()
            ->when($id_dashboard === 0 || Auth::user()->can('medicine_admin.see.dashboard'), function ($appointmentDashboard) {
                $appointmentDashboard->where('is_external', false);
            })
            ->when($id_dashboard === 1, function ($appointmentDashboard) {
                $appointmentDashboard->where('is_external', true);
            })
            ->when(Auth::user()->canany(['headquarters.see.dashboard', 'headquarters_authorized.see.dashboard']), function ($appointmentDashboard) {
                $appointmentDashboard->with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                    ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                        $q1->where('user_id', Auth::user()->id);
                    });
            })
            ->when(Auth::user()->can('sub_headquarters.see.dashboard'), function ($appointmentDashboard) use ($date1) {
                $appointmentDashboard->with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                    ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                        $q1->where('user_id', Auth::user()->id);
                    });
                $appointmentDashboard->where('headquarter_id', 6)->where('dateReserve', $date1);
            })
            ->select('status', DB::raw('count(*) as count'), 'dateReserve')
            ->groupBy('status', 'dateReserve')
            ->get();
        dd($appointmentDashboard);

        // HEADQUARTERS QUERY OPTIMIZED
        $headquarters = Headquarter::with(['headquarterMedicineReserve', 'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'])
            ->when(Auth::user()->canany(['headquarters.see.dashboard', 'sub_headquarters.see.dashboard', 'headquarters_authorized.see.dashboard']), function ($headquarters) {
                $headquarters->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
                    $q2->where('user_id', Auth::user()->id);
                });
            })
            ->when($id_dashboard === 0 || Auth::user()->can('medicine_admin.see.dashboard'), function ($headquarters) {
                $headquarters->where('is_external', 0);
            })
            ->when($id_dashboard === 1, function ($headquarters) {
                $headquarters->where('is_external', 1);
            })
            ->get(['id', 'name_headquarter', 'direction', 'is_external']);
        $this->headquarterQueries = $headquarters;


        $this->appointmentNow = $appointmentDashboard->where('dateReserve', $date1);
        $this->nowDate = ($id_dashboard === 0 || Auth::user()->canany(['headquarters.see.dashboard', 'sub_headquarters.see.dashboard', 'medicine_admin.see.dashboard'])) ? $this->appointmentNow->whereIn('status', ['0', '1', '4', '10'])->sum('count') : ($id_dashboard === 1 || Auth::user()->can('headquarters_authorized.see.dashboard') ? $this->appointmentNow->whereIn('status', ['0', '1', '4', '10', '7', '8', '9'])->sum('count') : null);
        $this->registerCount =  $appointmentDashboard->sum('count');
        $this->porConfirDashboard = $this->registerCount != 0 ? round($appointmentDashboard->where('status', '1')->sum('count') * 100 / $this->registerCount, 0) : 0;
        $this->validateDashboard = $appointmentDashboard->where('status', '1')->sum('count');
        $this->penDashboard = $appointmentDashboard->where('status', '0')->sum('count');
        $this->porPenDashboard = $this->registerCount != 0 ? round($appointmentDashboard->where('status', '0')->sum('count') * 100 / $this->registerCount, 0) : 0;
        $this->cancelDashboard = $appointmentDashboard->whereIn('status', ['2', '3', '5'])->sum('count');

        $this->reagDashboard = ($id_dashboard === 0 || Auth::user()->canany(['headquarters.see.dashboard', 'sub_headquarters.see.dashboard', 'medicine_admin.see.dashboard'])) ? round($appointmentDashboard->where('status', '4')->sum('count')) : ($id_dashboard === 1 || Auth::user()->can('headquarters_authorized.see.dashboard') ? round($appointmentDashboard->whereIn('status', ['4', '10'])->sum('count')) : null);
        $this->porReagDashboard = ($id_dashboard === 0 || Auth::user()->canany(['headquarters.see.dashboard', 'sub_headquarters.see.dashboard', 'medicine_admin.see.dashboard'])) ? ($this->registerCount != 0 ? round($appointmentDashboard->where('status', '4')->sum('count') * 100 / $this->registerCount) : 0) : ($id_dashboard === 1 || Auth::user()->can('headquarters_authorized.see.dashboard') ? ($this->registerCount != 0 ? round($appointmentDashboard->whereIn('status', ['4', '10'])->sum('count') * 100 / $this->registerCount) : 0) : null);
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
        return view('livewire.medicine.medicine-afac.home-medicine-afac');
    }
}
