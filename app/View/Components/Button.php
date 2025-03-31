<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public $text;
    public $id;
    public $href;
    public $onclick;
    public $type;
    public function __construct($text = 'Button', $id = null, $href = null, $onclick = null, $type = null)
    {
        $this->text = $text;
        $this->id = $id;
        $this->href = $href;
        $this->onclick = $onclick;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
