<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class li extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $route;
    public $icon;
    public $name;
    public $sec;

    public function __construct(?string $icon, string $name, string $route)
    {
        $this->route = $route;
        $this->icon = $icon;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.li');
    }
}
