<?php

namespace App\Http\Livewire\Medicine\Dashboard;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use Livewire\Component;

class DashboardMain extends Component
{
    public $id_dashboard, $date1, $date2;
    public $appointmentNow, $nowDate, $registerCount, $porConfirDashboard, $penDashboard, $porPenDashboard, $cancelDashboard, $reagDashboard,
        $porReagDashboard, $porCancelDashboard, $validateDashboard, $apto, $porApto, $noApto, $porNoApto, $aplazadas, $porAplazada, $headquarterQueries;
    public function mount($id_dashboard, $date1, $date2)
    {
        $this->id_dashboard = $id_dashboard;
        $this->date1 = $date1;
        $this->date2 = $date2;
        $user = Auth::user();
        $tomorrow = Date::tomorrow()->format('Y-m-d');
        $isAdmin  = $id_dashboard === 0 || Auth::user()->can('medicine_admin.see.dashboard');
        $iDashboard = $id_dashboard === 1;
        $canSeeDashboard = Auth::user()->canany(['headquarters.see.dashboard', 'headquarters_authorized.see.dashboard']);
        $headquartersDashboard = Auth::user()->can('sub_headquarters.see.dashboard');
        $headquarterSubHeadquarters = $user->canany(['headquarters.see.dashboard', 'sub_headquarters.see.dashboard', 'headquarters_authorized.see.dashboard']);

        $cacheKey = "appointmentDashboard_{$id_dashboard}_{$date1}_{$date2}";
        $appointmentDashboard = Cache::remember($cacheKey, now()->addMinutes(120), function () use ($isAdmin, $iDashboard, $canSeeDashboard, $headquartersDashboard, $date1) {
        return MedicineReserve::query()
            ->when($isAdmin, function ($query) {
                $query->where('is_external', false);
            })
            ->when($iDashboard, function ($query) {
                $query->where('is_external', true);
            })
            ->when($canSeeDashboard, function ($query) {
                $query->with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                    ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                        $q1->where('user_id', Auth::user()->id);
                    });
            })
            ->when($headquartersDashboard, function ($query) use ($date1) {
                $query->with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                    ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                        $q1->where('user_id', Auth::user()->id);
                    });
                $query->where('headquarter_id', 6)->where('dateReserve', $date1);
            })
            ->select('status', DB::raw('count(*) as count'), 'dateReserve')
            ->groupBy('status', 'dateReserve')
            ->get();
        });


        // HEADQUARTERS QUERY OPTIMIZED

        $cacheKeyHeadquarters = "headquarters_{$id_dashboard}";
        $headquarters = Cache::remember($cacheKeyHeadquarters, now()->addMinutes(120), function () use ($headquarterSubHeadquarters, $isAdmin, $date1, $iDashboard, $tomorrow) {
            return Headquarter::query()
            ->when($headquarterSubHeadquarters, function ($query) {
                $query->with(['HeadquarterUserHeadquarter.userHeadquarterUserParticipant'])
                    ->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q3) {
                        $q3->where('user_id', Auth::user()->id);
                    });
            })
            ->when($isAdmin, function ($headquarters) {
                $headquarters->where('is_external', 0)->where('status', 0);
            })
            ->when($iDashboard, function ($query) {
                $query->where('is_external', 1)->where('status', 0);
            })
            ->withCount(['headquarterMedicineReserve as countNow' => function ($query1) use ($date1) {
                $query1->where('dateReserve', $date1)->whereIn('status', ['0', '1', '4', '10', '8', '9']);
            }])
            ->withCount(['headquarterMedicineReserve as countTomorrow' => function ($query2) use ($tomorrow) {
                $query2->where('dateReserve', $tomorrow)->whereIn('status', ['0', '1', '4', '10', '8', '9']);
            }])
            ->withCount(['headquarterMedicineReserve as countTotal'])
            ->get(['id', 'name_headquarter', 'direction', 'is_external']);
        });

        $this->headquarterQueries = $headquarters;
        $this->headquarterQueries = $headquarters;
        $this->appointmentNow = $appointmentDashboard->where('dateReserve', $date1);
        $this->nowDate = ($id_dashboard === 0 || Auth::user()->canany(['headquarters.see.dashboard', 'sub_headquarters.see.dashboard', 'medicine_admin.see.dashboard'])) ? $this->appointmentNow->whereIn('status', ['0', '1', '4', '10'])->sum('count') : ($iDashboard || Auth::user()->can('headquarters_authorized.see.dashboard') ? $this->appointmentNow->whereIn('status', ['0', '1', '4', '10', '7', '8', '9'])->sum('count') : null);
        $this->registerCount =  $appointmentDashboard->sum('count');
        $this->porConfirDashboard = $this->registerCount != 0 ? round($appointmentDashboard->where('status', '1')->sum('count') * 100 / $this->registerCount, 0) : 0;
        $this->validateDashboard = $appointmentDashboard->where('status', '1')->sum('count');
        $this->penDashboard = $appointmentDashboard->where('status', '0')->sum('count');
        $this->porPenDashboard = $this->registerCount != 0 ? round($appointmentDashboard->where('status', '0')->sum('count') * 100 / $this->registerCount, 0) : 0;
        $this->cancelDashboard = $appointmentDashboard->whereIn('status', ['2', '3', '5'])->sum('count');

        $this->reagDashboard = ($id_dashboard === 0 || Auth::user()->canany(['headquarters.see.dashboard', 'sub_headquarters.see.dashboard', 'medicine_admin.see.dashboard'])) ? round($appointmentDashboard->where('status', '4')->sum('count')) : ($iDashboard || Auth::user()->can('headquarters_authorized.see.dashboard') ? round($appointmentDashboard->whereIn('status', ['4', '10'])->sum('count')) : null);
        $this->porReagDashboard = ($id_dashboard === 0 || Auth::user()->canany(['headquarters.see.dashboard', 'sub_headquarters.see.dashboard', 'medicine_admin.see.dashboard'])) ? ($this->registerCount != 0 ? round($appointmentDashboard->where('status', '4')->sum('count') * 100 / $this->registerCount) : 0) : ($iDashboard || Auth::user()->can('headquarters_authorized.see.dashboard') ? ($this->registerCount != 0 ? round($appointmentDashboard->whereIn('status', ['4', '10'])->sum('count') * 100 / $this->registerCount) : 0) : null);
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
        return view('livewire.medicine.dashboard.dashboard-main');
    }
}
