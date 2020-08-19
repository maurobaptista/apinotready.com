<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Input extends Component
{
    /** @var string */
    public $label;

    /** @var string */
    public $name;

    /** @var string */
    public $type;

    public function __construct(string $label, string $name, string $type = 'text')
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
    }

    public function render(): View
    {
        return view('components.input');
    }
}
