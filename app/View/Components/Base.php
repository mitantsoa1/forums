<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Base extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $title = "")
    {
        // $this->title = config('app.name') . ($title ? " | $title" : "");
        $this->title = $title == "" ? config('app.name') : " $title ";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.base');
    }
}
