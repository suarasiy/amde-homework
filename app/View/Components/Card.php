<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $title, $timestamp, $totalspectators, $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $timestamp, $totalspectators, $type)
    {
        $this->title = $title;
        $this->timestamp = $timestamp;
        $this->totalspectators = $totalspectators;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card');
    }
}
