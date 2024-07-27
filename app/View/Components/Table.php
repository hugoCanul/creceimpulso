<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public $columns;
    public $rows;
    public $displayColumns;

    /**
     * Create a new component instance.
     */
    public function __construct($columns = [], $rows = [], $displayColumns=[])
    {
        $this->columns = $columns;
        $this->rows = $rows;
        $this->displayColumns = $displayColumns;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table');
    }
}
