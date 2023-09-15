<?php

namespace App\View\Components\Permissions;

use Illuminate\View\Component;

class PermissionActionComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $permissionId;
    public function __construct($permissionId)
    {
        $this->permissionId = $permissionId;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.permissions.permission-action-component');
    }
}
