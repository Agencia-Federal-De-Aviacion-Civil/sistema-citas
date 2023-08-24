<?php

namespace App\View\Components\Headquarters;

use Illuminate\View\Component;

class DisabledDaysComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $actionId;
    public function __construct($actionId)
    {
        $this->actionId = $actionId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.headquarters.disabled-days-component');
    }
}
