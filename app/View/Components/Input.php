<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $title, $name, $default;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $name, $default ="")
    {
        $this->title = $title;
        $this->name = $name;
        $this->default = $default;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
