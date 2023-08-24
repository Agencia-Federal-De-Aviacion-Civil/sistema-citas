<?php

namespace App\View\Components\Headquarters;

use Illuminate\View\Component;

class EditHeadquarter extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $userId;
    public function __construct($userId)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.headquarters.edit-headquarter');
    }
}
