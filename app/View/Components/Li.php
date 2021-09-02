<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Li extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $route;
    public $icon;
    public $name;
    public $secondaries;

    public function __construct(?string $icon, string $name, string $route, string $secondaries = "")
    {
        $this->route = $route;
        $this->icon = $icon;
        $this->name = $name;
        $this->secondaries = $secondaries;
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
