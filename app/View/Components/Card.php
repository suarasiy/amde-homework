<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $title, $timestamp, $totalspectators, $type, $thumbnail, $spectators, $isdummy;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $timestamp, $totalspectators, $type, $thumbnail, $spectators, $isdummy)
    {
        $this->title = $title;
        $this->timestamp = $timestamp;
        $this->totalspectators = $totalspectators;
        $this->type = $type;
        $this->thumbnail = $thumbnail;
        $this->spectators = $spectators;
        $this->isdummy = $isdummy;
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
