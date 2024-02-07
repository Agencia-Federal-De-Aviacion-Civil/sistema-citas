<?php

namespace App\Http\Livewire\Medicine\Dashboard;

use Livewire\Component;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Facades\Auth;

class Calendar extends Component
{
    public $events = '', $id_dashboard;
    public function mount($id_dashboard)
    {
        $this->id_dashboard = $id_dashboard;
    }
    public function render()
    {
        $queryEvents = MedicineReserve::with('medicineReserveHeadquarter:id,name_headquarter')
            ->whereIn('status', [0, 1, 4, 10])
            ->when($this->id_dashboard === 0 || Auth::user()->can('medicine_admin.see.dashboard'), function ($queryEvents) {
                $queryEvents->where('is_external', false);
            })
            ->when($this->id_dashboard === 1, function ($queryEvents) {
                $queryEvents->where('is_external', true);
            })
            ->when(Auth::user()->canany(['headquarters.see.dashboard', 'headquarters_authorized.see.dashboard']), function ($queryEvents) {
                $queryEvents->with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                    ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                        $q1->where('user_id', Auth::user()->id);
                    });
            })
            ->when(Auth::user()->can('sub_headquarters.see.dashboard'), function ($queryEvents) {
                $queryEvents->with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                    ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                        $q1->where('user_id', Auth::user()->id);
                    });
            })
            ->get(['id', 'headquarter_id', 'medicine_id', 'dateReserve']);
        $groupedEvents = $queryEvents->groupBy(function ($event) {
            return $event->medicineReserveHeadquarter->name_headquarter . '_' . $event->dateReserve;
        });
        $events = $groupedEvents->map(function ($events) {
            $count = $events->count();

            return [
                'id' => $events->first()->id,
                'title' => $events->first()->medicineReserveHeadquarter->name_headquarter . ' (' . $count . ')',
                'start' => $events->first()->dateReserve,
            ];
        })->values();
        $this->events = json_encode($events);
        return view('livewire.medicine.dashboard.calendar');
    }
}
