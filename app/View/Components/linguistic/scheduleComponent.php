<?php

namespace App\View\Components\linguistic;

use Illuminate\View\Component;

class scheduleComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $scheduleId,$linguisticId, $status;
    public $modal;
    public function __construct($scheduleId, $linguisticId, $status)
    {
        $this->scheduleId = $scheduleId;
        $this->linguisticId = $linguisticId;
        $this->status = $status;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.linguistic.schedule-component');
    }
}
