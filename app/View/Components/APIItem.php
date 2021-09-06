<?php

namespace App\View\Components;

use Illuminate\View\Component;

class APIItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $name;
    public $verb;
    public $endpoint;
    public $parameters;

    public function __construct($name, $verb = "GET", $parameters = "", $endpoint )
    {
        $this->name = $name;
        $this->verb = $verb;
        $this->endpoint = $endpoint;
        $this->parameters = $parameters;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.api_item');
    }
}
