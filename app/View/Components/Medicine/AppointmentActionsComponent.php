<?php

namespace App\View\Components\Medicine;

use Illuminate\View\Component;

class AppointmentActionsComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $scheduleId, $medicineId, $status;
    public $modal;
    public function __construct($scheduleId, $medicineId, $status)
    {
        $this->scheduleId = $scheduleId;
        $this->medicineId = $medicineId;
        $this->status = $status;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.medicine.appointment-actions-component');
    }
}
