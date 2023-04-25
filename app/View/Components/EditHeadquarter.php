<?php

namespace App\View\Components;

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
        $this->userId = $userId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.edit-headquarter');
    }
}
