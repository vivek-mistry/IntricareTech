<?php

namespace App\View\Components\Backend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $ui;

    public $uiType;

    public $label;

    public $class;

    public $colorType;

    public $icon;

    /**
     * Create a new component instance.
     */
    public function __construct($ui, $label = '', $class = '', $colorType = '', $uiType = 'rounded', $icon = '')
    {
        $this->ui = $ui;
        $this->label = $label;
        $this->class = $class;
        $this->colorType = $colorType;
        $this->uiType = $uiType;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.backend.button');
    }
}
