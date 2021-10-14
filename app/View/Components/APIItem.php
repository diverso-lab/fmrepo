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
    public $body_request;
    public $info_message;

    public function __construct($name,$endpoint, $verb = "GET", $parameters = "", $body_request = "", $info_message = "" )
    {
        $this->name = $name;
        $this->verb = $verb;
        $this->endpoint = $endpoint;
        $this->parameters = $parameters;
        $this->body_request = $body_request;
        $this->info_message = $info_message;
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
