<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Medicine\MedicineReserve;

class Calendar extends Component
{
    public $events = '';

    public function getevent()
    {
        $events = MedicineReserve::select('id', 'medicine_id as title', 'dateReserve as start')
            ->where('status', 'in(0,1,4)')
            ->get();
        return  json_encode($events);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addevent($event)
    {
        $input['medicine_id'] = $event['medicine_id'];
        $input['dateReserve'] = $event['dateReserve'];
        MedicineReserve::create($input);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function eventDrop($event, $oldEvent)
    {
        $eventdata = MedicineReserve::find($event['id']);
        $eventdata->start = $event['dateReserve'];
        $eventdata->save();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function render()
    {

        $queryEvents = MedicineReserve::with('medicineReserveHeadquarter')
            ->whereIn('status', [0, 1, 4])
            ->get();
        $groupedEvents = $queryEvents->groupBy(function ($event) {
            return isset($event->medicineReserveHeadquarter->name_headquarter) ? $event->medicineReserveHeadquarter->name_headquarter : '' . '_' . $event->dateReserve;
        });
        $events = $groupedEvents->map(function ($events) {
            $count = $events->count();

            return [
                'id' => $events->first()->id,
                'title' => isset($events->first()->medicineReserveHeadquarter->name_headquarter) ? $events->first()->medicineReserveHeadquarter->name_headquarter : '' . ' (' . $count . ')',
                'start' => $events->first()->dateReserve,
            ];
        })->values();
        $this->events = json_encode($events);
        return view('livewire.calendar');
    }
}
