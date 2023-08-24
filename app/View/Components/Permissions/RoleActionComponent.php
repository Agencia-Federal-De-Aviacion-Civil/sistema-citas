<?php

namespace App\View\Components\Permissions;

use Illuminate\View\Component;

class RoleActionComponent extends Component
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
        return view('components.permissions.role-action-component');
    }
}
