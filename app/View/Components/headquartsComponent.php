<?php

namespace App\View\Components;

use Illuminate\View\Component;

class headquartsComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $scheduleId,$status;
    public $modal;
    public function __construct($scheduleId,$status)
    {
        $this->scheduleId = $scheduleId;
        $this->status = $status;   
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    

    public function render()
    {
        return view('components.headquarts-component');
    }
}
