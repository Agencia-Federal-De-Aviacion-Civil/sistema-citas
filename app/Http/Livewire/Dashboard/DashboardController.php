<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use WireUi\Traits\Actions;

class DashboardController extends Component
{
    use Actions;
    public $headquarters, $dateNow, $registradas, $medicine, $nameHeadquarter, $pendientes, $porpendientes,
    $validado,$porconfir,$reagendado,$porreagendado, $canceladas, $porcanceladas, $now, $date1, $date2, $tomorrow,
    $selectedHeadquarter, $headquartersAfac, $stategrup,$headquartersAfac1;

    public function mount(){
        $this->headquartersAfac = Headquarter::where('status', 0)->get();
        $stategrup = $this->headquartersAfac->groupBy('state')?? null   ;
        $this->stategrup =$stategrup->all();
    }

    public function rules()
    {
        return [
            'selectedHeadquarter' => 'required',
        ];
    }

    public function render()
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');
        $date = Date::now()->format('l j F Y');
        $date1 = Date::now()->format('Y-m-d');
        $this->date2 = Date::now()->format('d-m-Y');
        $this->tomorrow = Date::tomorrow()->format('Y-m-d');
        $nameHeadquarter = '';
        if (Auth::user()->can('headquarters.see.dashboard')) {

            $appointment = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                    $q1->where('user_id', Auth::user()->id);
                })
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->get();
            $headquarter = Headquarter::with([
                'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
            ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
                $q2->where('user_id', Auth::user()->id);
            })->get();
            $this->nameHeadquarter = $headquarter->pluck('name_headquarter')->first();
            $this->headquarters = $headquarter;
        } else if (Auth::user()->can('sub_headquarters.see.dashboard')) {
            $appointment = MedicineReserve::with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q3) {
                    $q3->where('user_id', Auth::user()->id);
                })
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->where('headquarter_id', 6)
                ->where('dateReserve', $date1)
                ->get();
            $headquarters = Headquarter::with([
                'HeadquarterUserHeadquarter.userHeadquarterUserParticipant'
            ])->whereHas('HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q2) {
                $q2->where('user_id', Auth::user()->id);
            })->get();
        } else {
            $appointment = MedicineReserve::query()
                ->select('status', DB::raw('count(*) as count'), 'dateReserve')
                ->groupBy('status', 'dateReserve')
                ->get();
            $headquarters = Headquarter::with([
                'headquarterMedicineReserve'
            ])
                ->where('is_external', false)
                ->get();

                $this->headquarters = $headquarters;

        }

        $appointmentNow = $appointment->where('dateReserve', $date1);
        $this->now = $appointmentNow->whereIn('status', ['0', '1', '4'])->sum('count');
        $registradas = $appointment->sum('count');
        $this->porconfir = $registradas != 0 ? round($appointment->where('status', '1')->sum('count') * 100 / $registradas, 0) : 0;
        $this->validado = $appointment->where('status', '1')->sum('count');
        $this->pendientes = $appointment->where('status', '0')->sum('count');
        $this->porpendientes = $registradas != 0 ? round($appointment->where('status', '0')->sum('count') * 100 / $registradas, 0) : 0;
        $this->canceladas = $appointment->whereIn('status', ['2', '3', '5'])->sum('count');
        $this->reagendado = round($appointment->where('status', '4')->sum('count'));
        $this->porreagendado = $registradas != 0 ? round($appointment->where('status', '4')->sum('count') * 100 / $registradas) : 0;
        $this->porcanceladas = $registradas != 0 ? round($appointment->whereIn('status', ['2', '3', '5'])->sum('count') * 100 / $registradas, 0) : 0;
        $this->medicine =  round($registradas ? $registradas * 100 / $registradas : '0');
        $this->registradas = $appointment->sum('count');

        $this->date1;
        if(Auth::user()->can('super_admin.see.dashboard')){

        return view('livewire.dashboard.dashboard-controller');

        }else if(Auth::user()->can('headquarters.see.dashboard')){

        return view('afac.dashboard.dashboard_headquarters');

        }else if(Auth::user()->can('sub_headquarters.see.dashboard')){

        return view('afac.dashboard.dashboard_headquarters');

        }else if(Auth::user()->can('medicine_admin.see.dashboard')){

        return view('afac.dashboard.dashboard_medicine');

        }else if(Auth::user()->can('user.see.navigation')){

        return view('livewire.dashboard');

        }else if(Auth::user()->can('headquarters_authorized.see.dashboard')){

        return view('afac.dashboard.dashboard_headquarters_third');

        }

    }
    public function selected()
    {
        $this->validate();
        $selectedValues = explode('-', $this->selectedHeadquarter);
        $id = $selectedValues[0];
        $idTypeAppointment = boolval($selectedValues[1]);
        session(['idType' => $idTypeAppointment, 'idHeadquarter' => $id]);
        // redirect()->route('afac.medicine');
    }

    public function goAfac($idTypeAppointment)
    {
        // $currentIdType = session('idType');
        // dd($currentIdType);
        // if ($currentIdType !== $idTypeAppointment) {
        //     session()->forget('idType');
        // }
        // session(['idType' => $idTypeAppointment]);
    }
    public function messages()
    {
        return [
            'selectedHeadquarter.required' => 'Campo obligatorio'
        ];
    }

    }
