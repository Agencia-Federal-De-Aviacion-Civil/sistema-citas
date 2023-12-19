<?php

namespace App\Http\Livewire\Medicine\AuthorizedThird;

use App\Models\Medicine\MedicineReserve;
use App\Models\Catalogue\Headquarter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CalendarSuperAdmin extends Component
{
    public $events = '';
    public function render()
    {
        if (Auth::user()->can('headquarters_authorized.see.dashboard')) {

            $queryEvents = MedicineReserve::with('medicineReserveHeadquarter')
                ->whereIn('status', [0, 1, 4, 10, 7,8])
                ->where('is_external', true)
                ->whereHas('medicineReserveHeadquarter.HeadquarterUserHeadquarter.userHeadquarterUserParticipant', function ($q1) {
                    $q1->where('user_id', Auth::user()->id);
                })
                ->get();
            $groupedEvents = $queryEvents->groupBy(function ($event) {
                return $event->medicineReserveHeadquarter->name_headquarter . '_' . $event->dateReserve;
            });
            $events = $groupedEvents->map(function ($events) {
                $count = $events->count();

                return [
                    'id' => $events->first()->id,
                    // 'title' => $events->first()->medicineReserveHeadquarter->name_headquarter . ' (' . $count . ')',
                    'title' => "CITAS" . ' (' . $count . ')',
                    'start' => $events->first()->dateReserve,
                ];
            })->values();
            $this->events = json_encode($events);
        } else {
            $queryEvents = MedicineReserve::with('medicineReserveHeadquarter')
                ->whereIn('status', [0, 1, 4, 10, 7,8])
                ->where('is_external', true)
                ->get();
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
        }
        return view('livewire.medicine.authorized-third.calendar');
    }
}
