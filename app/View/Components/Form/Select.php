<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Select extends Component
{

    /** @var string */
    public $label;

    /** @var string */
    public $name;

    /** @var array */
    public $options;

    /** @var string */
    public $displayPattern;

    /**
     * Select constructor.
     * @param string $label
     * @param string $name
     * @param array $options
     * @param string $displayPattern
     */
    public function __construct(string $label, string $name, $options = [], string $displayPattern = '%value%')
    {
        $this->label = $label;
        $this->name = $name;
        $this->options = $options;
        $this->displayPattern = $displayPattern;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.select');
    }

    /**
     * @param string $key
     * @param string $value
     * @return string
     */
    public function display(string $key, string $value): string
    {
        return str_replace(['%key%', '%value%'], [$key, $value], $this->displayPattern);
    }
}
