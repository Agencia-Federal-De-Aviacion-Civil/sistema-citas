<?php

namespace App\Http\Livewire\Medicine\AuthorizedThird;

use App\Models\Medicine\MedicineReserve;
use Livewire\Component;

class Calendar extends Component
{
    public $events = '';
    public function render()
    {
        $queryEvents = MedicineReserve::with('medicineReserveHeadquarter')
            ->whereIn('status', [0, 1, 4])
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
        return view('livewire.medicine.authorized-third.calendar');
    }
}
