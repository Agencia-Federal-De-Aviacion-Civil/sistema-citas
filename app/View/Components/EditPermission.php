<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EditPermission extends Component
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
        return view('components.edit-permission');
    }
}
