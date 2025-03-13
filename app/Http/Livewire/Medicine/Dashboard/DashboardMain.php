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
        $tomorrow = Date::tomorrow()->format('Y-m-d');

        $appointmentDashboard = $this->getAppointmentDashboard($id_dashboard, $date1);
        $headquarters = $this->getHeadquarters($id_dashboard, $date1, $tomorrow);

        $this->headquarterQueries = $headquarters;
        $this->appointmentNow = $appointmentDashboard->where('dateReserve', $date1);
        $this->registerCount = $appointmentDashboard->sum('count');

        $this->calculateDashboardMetrics($appointmentDashboard, $id_dashboard);
    }

    public function render()
    {
        return view('livewire.medicine.dashboard.dashboard-main');
    }
    private function getAppointmentDashboard($id_dashboard, $date1)
    {
        $cacheKey = "appointment_dashboard_{$id_dashboard}_{$date1}";
        return Cache::remember($cacheKey, 120, function () use ($id_dashboard, $date1) {
            $query = MedicineReserve::query();

            if ($id_dashboard === 0 || Auth::user()->can('medicine_admin.see.dashboard')) {
                $query->where('is_external', false);
            } elseif ($id_dashboard === 1) {
                $query->where('is_external', true);
            }

            if (Auth::user()->canany(['headquarters.see.dashboard', 'headquarters_authorized.see.dashboard'])) {
                $query->with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                    ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q) {
                        $q->where('user_id', Auth::user()->id);
                    });
            }

            if (Auth::user()->can('sub_headquarters.see.dashboard')) {
                $query->with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                    ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q) {
                        $q->where('user_id', Auth::user()->id);
                    })
                    ->where('headquarter_id', 6)
                    ->where('dateReserve', $date1);
            }

            return $query->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->get();
        });
    }

    private function getHeadquarters($id_dashboard, $date1, $tomorrow)
    {
        $cacheKey = "headquarters_{$id_dashboard}_{$date1}_{$tomorrow}";
        return Cache::remember($cacheKey, 120, function () use ($id_dashboard, $date1, $tomorrow) {
            $query = Headquarter::query();

            if (Auth::user()->canany(['headquarters.see.dashboard', 'sub_headquarters.see.dashboard', 'headquarters_authorized.see.dashboard'])) {
                $query->with(['HeadquarterUserHeadquarter.userHeadquarterUserParticipant'])
                    ->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q) {
                        $q->where('user_id', Auth::user()->id);
                    });
            }

            if ($id_dashboard === 0 || Auth::user()->can('medicine_admin.see.dashboard')) {
                $query->where('is_external', 0)->where('status', 0);
            } elseif ($id_dashboard === 1) {
                $query->where('is_external', 1)->where('status', 0);
            }

            return $query->withCount([
                'headquarterMedicineReserve as countNow' => function ($query) use ($date1) {
                    $query->where('dateReserve', $date1)->whereIn('status', ['0', '1', '4', '10', '8', '9']);
                },
                'headquarterMedicineReserve as countTomorrow' => function ($query) use ($tomorrow) {
                    $query->where('dateReserve', $tomorrow)->whereIn('status', ['0', '1', '4', '10', '8', '9']);
                },
                'headquarterMedicineReserve as countTotal'
            ])->get(['id', 'name_headquarter', 'direction', 'is_external']);
        });
    }

    private function calculateDashboardMetrics($appointmentDashboard, $id_dashboard)
    {
        $this->nowDate = $this->calculateNowDate($appointmentDashboard, $id_dashboard);
        $this->porConfirDashboard = $this->calculatePercentage($appointmentDashboard, '1');
        $this->validateDashboard = $appointmentDashboard->where('status', '1')->sum('count');
        $this->penDashboard = $appointmentDashboard->where('status', '0')->sum('count');
        $this->porPenDashboard = $this->calculatePercentage($appointmentDashboard, '0');
        $this->cancelDashboard = $appointmentDashboard->whereIn('status', ['2', '3', '5'])->sum('count');
        $this->reagDashboard = $this->calculateReagDashboard($appointmentDashboard, $id_dashboard);
        $this->porReagDashboard = $this->calculateReagPercentage($appointmentDashboard, $id_dashboard);
        $this->porCancelDashboard = $this->calculatePercentage($appointmentDashboard, ['2', '3', '5']);
        $this->apto = $appointmentDashboard->where('status', '8')->sum('count');
        $this->porApto = $this->calculatePercentage($appointmentDashboard, '8');
        $this->noApto = $appointmentDashboard->where('status', '9')->sum('count');
        $this->porNoApto = $this->calculatePercentage($appointmentDashboard, '9');
        $this->aplazadas = $appointmentDashboard->where('status', '7')->sum('count');
        $this->porAplazada = $this->calculatePercentage($appointmentDashboard, '7');
    }

    private function calculateNowDate($appointmentDashboard, $id_dashboard)
    {
        $statuses = ['0', '1', '4', '10'];
        if ($id_dashboard === 1 || Auth::user()->can('headquarters_authorized.see.dashboard')) {
            $statuses = array_merge($statuses, ['7', '8', '9']);
        }
        return $appointmentDashboard->whereIn('status', $statuses)->sum('count');
    }

    private function calculatePercentage($appointmentDashboard, $status)
    {
        return $this->registerCount != 0 ? round($appointmentDashboard->whereIn('status', (array)$status)->sum('count') * 100 / $this->registerCount, 0) : 0;
    }

    private function calculateReagDashboard($appointmentDashboard, $id_dashboard)
    {
        $statuses = ['4'];
        if ($id_dashboard === 1 || Auth::user()->can('headquarters_authorized.see.dashboard')) {
            $statuses = array_merge($statuses, ['10']);
        }
        return round($appointmentDashboard->whereIn('status', $statuses)->sum('count'));
    }

    private function calculateReagPercentage($appointmentDashboard, $id_dashboard)
    {
        $statuses = ['4'];
        if ($id_dashboard === 1 || Auth::user()->can('headquarters_authorized.see.dashboard')) {
            $statuses = array_merge($statuses, ['10']);
        }
        return $this->registerCount != 0 ? round($appointmentDashboard->whereIn('status', $statuses)->sum('count') * 100 / $this->registerCount) : 0;
    }
}
