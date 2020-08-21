<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;
use Illuminate\View\View;

class Textarea extends Component
{
    /** @var string */
    public $label;

    /** @var string */
    public $name;

    /**
     * TextArea constructor.
     * @param string $label
     * @param string $name
     */
    public function __construct(string $label, string $name)
    {
        $this->label = $label;
        $this->name = $name;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('components.form.textarea');
    }
}
