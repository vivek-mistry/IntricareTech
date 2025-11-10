<?php

namespace App\View\Components\Backend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    public $type;

    public $label;

    public $class;

    /**
     * Create a new component instance.
     */
    public function __construct($type, $label = '', $class = '')
    {
        $this->type = $type;
        $this->label = $label;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.backend.badge');
    }
}
