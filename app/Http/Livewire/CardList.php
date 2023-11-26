<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CardList extends Component
{
    protected $listeners = ['testing' => 'increment', 'paginate_previous', 'paginate_next', 'set_auto_update', 'is_refreshed'];
    public $count = 0;
    public $data, $origin;
    public $auto_update_options = [
        "refetch_data" => true,
        "interval" => "3s" // format "<number>ms || <number>s"
    ];
    protected $options = [
        "limit" => 2, // feel free to change it
    ];
    public $pagination_options = [
        "current_page" => 1,
        "has_previous" => false,
        "has_next" => false,
        "total_page" => 0
    ];

    private function on_paginate()
    {
        $this->pagination_options['current_page'] > 1 ? $this->pagination_options['has_previous'] = true : $this->pagination_options['has_previous'] = false;
        if ($this->pagination_options['current_page'] < $this->pagination_options['total_page']) {
            $this->pagination_options['has_next'] = true;
            $this->get_paginated_data();
            return;
        }
        $this->get_paginated_data();
        return $this->pagination_options['has_next'] = false;
    }

    private function initial_data(bool $shuffle = false)
    {
        // define dummy data
        $origin = [
            ['title'  => 'Let\'s watch together! Ariana Broadcast', 'time' => date('M d, Y'), 'type' => 'started', 'total_spectators' => rand(5, 100)],
            ['title'  => 'Anisong piano cover - #3', 'time' => date('M d, Y'), 'type' => 'soon', 'total_spectators' => rand(5, 100)],
            ['title'  => 'NightyF - Graphic Design on Figma', 'time' => date('M d, Y'), 'type' => 'soon', 'total_spectators' => rand(5, 100)],
            ['title'  => 'Explore through everest mountain!', 'time' => date('M d, Y'), 'type' => 'started', 'total_spectators' => rand(5, 100)],
            ['title'  => 'Geoguessr with Tantei Seia', 'time' => date('M d, Y'), 'type' => 'ended', 'total_spectators' => rand(5, 100)],
        ];

        // shuffle the origin data
        if ($shuffle) {
            $origin = collect($origin)->shuffle();
        }

        // assign origin into public origin
        $this->origin = $origin;

        $this->get_paginated_data();
    }

    private function initial_options()
    {
        $this->initial_data();
        // update pagination_config
        $this->pagination_options["total_page"] = round(count($this->origin) / $this->options["limit"]);
        $this->on_paginate();
    }

    public function mount()
    {
        $this->initial_options();
        // note: I thought I can create emit on-mount...
    }

    public function __construct()
    {
        $this->emit('auto_update_options', $this->auto_update_options);
        // $this->initial_options();
    }

    public function increment()
    {
        $this->count++;
    }

    private function get_paginated_data()
    {
        // slice the dummy data into pagination
        $this->data = collect($this->origin)->forPage($this->pagination_options['current_page'], $this->options['limit']);
    }

    public function paginate_next()
    {
        $this->pagination_options['has_next'] ? $this->pagination_options['current_page']++ : null;
        $this->on_paginate();
    }

    public function paginate_previous()
    {
        $this->pagination_options['has_previous'] ? $this->pagination_options['current_page']-- : null;
        $this->on_paginate();
    }

    public function get_refreshed_data()
    {
        if ($this->auto_update_options["refetch_data"]) {
            $this->initial_data(true);
            // $shuffled = collect($this->data)->shuffle();
            // $this->data = $shuffled;
        }
        $this->emit('is_refreshed');
    }

    public function set_auto_update()
    {
        $this->auto_update_options['refetch_data'] = !$this->auto_update_options['refetch_data'];
        // $this->emit('auto_update_options', $this->auto_update_options);
    }

    public function is_refreshed()
    {
        // 
    }

    public function render()
    {
        // $this->emit('auto_update_options', $this->auto_update_options);
        return view('livewire.card-list');
    }
}
