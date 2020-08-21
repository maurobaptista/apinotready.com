<?php

namespace App\View\Components\Form;

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

    /**
     * Input constructor.
     * @param string $label
     * @param string $name
     * @param string $type
     */
    public function __construct(string $label, string $name, string $type = 'text')
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('components.form.input');
    }
}
