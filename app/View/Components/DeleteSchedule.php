<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DeleteSchedule extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $deleteId;
    public function __construct($deleteId)
    {
        $this->deleteId = $deleteId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.delete-schedule');
    }
}
