<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Pagination extends Component
{
    public $data = 0;
    public $has_previous;

    // public function __construct($paginate_previous, $paginate_next)
    // {
    //     $this->paginate_previous = $paginate_previous;
    //     $this->paginate_next = $paginate_next;
    // }

    public function render()
    {
        return view('livewire.pagination');
    }
}
