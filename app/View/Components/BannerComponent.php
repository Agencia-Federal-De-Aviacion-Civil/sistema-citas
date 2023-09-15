<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Jenssegers\Date\Date;

class BannerComponent extends Component
{
    public $title, $dateNow;
    public function __construct($title)
    {
        Date::setLocale('es');
        $this->dateNow = Date::now()->format('l j F Y');
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.banner-component');
    }
}
