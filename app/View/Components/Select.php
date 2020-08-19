<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{

    /** @var string */
    public $label;

    /** @var string */
    public $name;

    /** @var array */
    public $options;

    public function __construct(string $label, string $name, $options = [])
    {
        $this->label = $label;
        $this->name = $name;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.select');
    }
}
