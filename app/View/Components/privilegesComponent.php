<?php

namespace App\View\Components;

use Illuminate\View\Component;

class privilegesComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $privilegesId;
    
    public function __construct($privilegesId)
    {
        $this->privilegesId = $privilegesId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        
        return view('components.privileges-component');
    }
}
