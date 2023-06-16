<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActionRoles extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $rolesId;
    public function __construct($rolesId)
    {
        $this->rolesId = $rolesId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.action-roles');
    }
}
