<?php

namespace App\Http\Livewire\Medicine\Dashboard;

use Livewire\Component;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CalendarAfac extends Component
{
    public $events = '';
    public function render()
    {
        $cacheKey = 'calendar_afac_events_' . Auth::user()->id;
        $queryEvents = Cache::remember($cacheKey, 120, function () {
            return MedicineReserve::with('medicineReserveHeadquarter:id,name_headquarter')
                ->when(Auth::user()->canany(['headquarters.see.dashboard', 'headquarters_authorized.see.dashboard', 'sub_headquarters.see.dashboard']), function ($query) {
                    $query->with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                        ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q) {
                            $q->where('user_id', Auth::user()->id);
                        });
                })
                ->where('is_external', false)
                ->whereIn('status', [0, 1, 4, 10])
                ->get(['id', 'headquarter_id', 'medicine_id', 'dateReserve']);
        });

        $groupedEvents = $queryEvents->groupBy(function ($event) {
            return $event->medicineReserveHeadquarter->name_headquarter . '_' . $event->dateReserve;
        });

        $events = $groupedEvents->map(function ($events) {
            $firstEvent = $events->first();
            return [
                'id' => $firstEvent->id,
                'title' => $firstEvent->medicineReserveHeadquarter->name_headquarter . ' (' . $events->count() . ')',
                'start' => $firstEvent->dateReserve,
            ];
        })->values();

        $this->events = json_encode($events);
        return view('livewire.medicine.dashboard.calendar-afac');
    }
}
