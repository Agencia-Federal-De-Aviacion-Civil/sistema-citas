<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BannerModalIcon extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public ?string $title;
    public ?string $size;
    public ?string $icon;
    public ?string $titlesize;

    public function __construct(?string $title = null,?string $size = null,?string $icon = null,?string $titlesize= null)
    {
        $this->title = $title;
        $this->size = $size;
        $this->icon = $icon;
        $this->titlesize = $titlesize;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.banner-modal-icon');
    }
}
