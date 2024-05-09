<?php

namespace App\Http\Livewire\Medicine\Dashboard;

use App\Models\Medicine\MedicineReserve;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CalendarThird extends Component
{
    public $events = '';

    public function render()
    {
        $queryEvents = MedicineReserve::with('medicineReserveHeadquarter:id,name_headquarter')
            ->when(Auth::user()->canany(['headquarters.see.dashboard', 'headquarters_authorized.see.dashboard', 'sub_headquarters.see.dashboard']), function ($queryEvents) {
                $queryEvents->with('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant')
                    ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                        $q1->where('user_id', Auth::user()->id);
                    });
            })
            ->where('is_external', true)
            ->whereIn('status', [0, 1, 4, 10])
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
        return view('livewire.medicine.dashboard.calendar-third');
    }
}
