<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class StoreFrontLayout extends Component
{
    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = '')
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $categories = Category::all();
        return view('layouts.store-front', [
            'categories' => $categories,
        ]);
    }
}
