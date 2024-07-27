<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectModel extends Component
{
    public $options;
    public $selected;
    public $valueField;
    public $labelField;
    public $label;

    /**
     * Create a new component instance.
     */
    public function __construct($options = [], $selected = null, $valueField = 'id', $labelField = 'name', $label = '')
    {
        $this->options = $options;
        $this->selected = $selected;
        $this->valueField = $valueField;
        $this->labelField = $labelField;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-model');
    }
}
