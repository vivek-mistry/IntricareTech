<?php

namespace App\View\Components\Backend;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryDropdown extends Component
{
    public $categories;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->categories = Category::get()->pluck('name', 'id');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.backend.category-dropdown');
    }
}
