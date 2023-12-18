<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BannerModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public ?string $title;
    public ?string $information;
    public ?string $icon;
    
    public function __construct(?string $title = null,?string $information = null,?string $icon = null)
    {
        $this->title = $title;
        $this->information = $information;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.banner-modal');
    }
}
