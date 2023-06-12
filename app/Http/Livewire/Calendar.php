<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Medicine\MedicineReserve;

class Calendar extends Component
{
    public $events = '';

    public function getevent()
    {       
        $events = MedicineReserve::select('id','medicine_id as title' ,'dateReserve as start')->get();
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
        $events = MedicineReserve::select('id','medicine_id as title' ,'dateReserve as start')->get();
       // dd($events);
        $this->events = json_encode($events);
        return view('livewire.calendar');

    }
}
