<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CardList extends Component
{
    protected $listeners = ['paginate_previous', 'paginate_next', 'set_auto_update'];
    public $dummy_counter = 0;
    public $paginated_data, $current_data, $dummy_data;

    public $auto_update_options = [
        "refetch_data" => true,
        "interval" => "3s" // format "<number>ms || <number>s"
    ];
    protected $options = [
        "limit" => 10, // feel free to change it
    ];
    public $pagination_options = [
        "current_page" => 1,
        "has_previous" => false,
        "has_next" => false,
        "total_page" => 0
    ];

    private function on_paginate()
    {
        // 'has_previous' will be true if the current_pagination above 1
        $this->pagination_options['current_page'] > 1 ? $this->pagination_options['has_previous'] = true : $this->pagination_options['has_previous'] = false;

        // 'has_next' will be true if the current_pagination below total pages
        if ($this->pagination_options['current_page'] < $this->pagination_options['total_page']) {
            $this->pagination_options['has_next'] = true;
            $this->get_paginated_data();
            return;
        }
        $this->get_paginated_data();
        return $this->pagination_options['has_next'] = false;
    }

    private function initial_data()
    {
        $this->dummy_data = collect();
        $this->current_data = $this->update_current_data();

        $this->get_paginated_data();
    }

    private function initial_options()
    {
        $this->initial_data();
        $this->update_pagination_options();
    }

    public function mount()
    {
        $this->initial_options();
    }

    public function __construct()
    {
        $this->emit('auto_update_options', $this->auto_update_options);
    }

    public function push_dummy_data($shuffle = false)
    {
        $this->dummy_counter++;
        $this->dummy_data->push(['title'  => "(Dummy $this->dummy_counter) Push Data", 'time' => date('M d, Y'), 'type' => 'soon', 'total_spectators' => rand(5, 100), 'thumbnail' => 'https://picsum.photos/1000/1000', 'spectators' => $this->get_random_avatar(), 'is_dummy' => true]);
        $this->update_current_data($shuffle);
    }

    private function get_paginated_data()
    {
        $this->paginated_data = collect($this->current_data)->forPage($this->pagination_options['current_page'], $this->options['limit']);
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
            $this->update_current_data(true);
        }
        $this->dispatchBrowserEvent('is_refreshed', ['data' => $this->auto_update_options]);
    }

    public function set_auto_update()
    {
        $this->auto_update_options['refetch_data'] = !$this->auto_update_options['refetch_data'];
    }

    public function render()
    {
        return view('livewire.card-list');
    }

    private function update_current_data($shuffle = false)
    {
        $current_data = collect();
        $current_data = $current_data->merge($this->get_original_data())->merge($this->dummy_data);
        $this->current_data = $current_data;
        if ($shuffle) {
            $this->shuffle_data();
        }
        $this->update_pagination_options();
        $this->get_paginated_data();
        return $current_data;
    }

    public function shuffle_current_data()
    {
        $this->shuffle_data();
        $this->update_pagination_options();
        $this->get_paginated_data();
    }

    private function shuffle_data()
    {
        $this->current_data = collect($this->current_data)->shuffle();
    }

    private function update_pagination_options()
    {
        $total_page = ceil(count($this->current_data) / $this->options["limit"]);
        $this->pagination_options["total_page"] = $total_page;
        $this->on_paginate();
    }

    private function get_random_avatar()
    {
        $initial_avatars = collect([
            "https://ui-avatars.com/api/?background=5653A3&color=FFFFFF&name=Sidiq",
            "https://ui-avatars.com/api/?background=AE2DCA&color=FFFFFF&name=Indrajati",
            "https://ui-avatars.com/api/?background=CC2B53&color=FFFFFF&name=Yusuf",
            "https://ui-avatars.com/api/?background=C4B133&color=FFFFFF&name=Mashiro",
            "https://ui-avatars.com/api/?background=2CCB6B&color=FFFFFF&name=Shiina",
        ]);
        return $initial_avatars->shuffle()->random(3);
    }

    private function get_original_data()
    {
        return collect([
            ['title'  => 'Let\'s watch together! Ariana Broadcast', 'time' => date('M d, Y'), 'type' => 'started', 'total_spectators' => rand(5, 100), 'thumbnail' => 'https://pm1.aminoapps.com/7945/d6f9629d1edad4dc4bce712bf6ad3e2ae575f22dr1-1280-720v2_hq.jpg', 'spectators' => $this->get_random_avatar(), 'is_dummy' => false],
            ['title'  => 'Art Club (theme: Ocean)', 'time' => date('M d, Y'), 'type' => 'soon', 'total_spectators' => rand(5, 100), 'thumbnail' => 'https://static.zerochan.net/Shiina.Mashiro.full.1607930.jpg', 'spectators' => $this->get_random_avatar(), 'is_dummy' => false],
            ['title'  => 'NightyF - Graphic Design on Figma', 'time' => date('M d, Y'), 'type' => 'soon', 'total_spectators' => rand(5, 100), 'thumbnail' => 'https://images.fineartamerica.com/images-medium-large-5/small-magellanic-cloud-smc-galaxy-ram-vasudev.jpg', 'spectators' => $this->get_random_avatar(), 'is_dummy' => false],
            ['title'  => 'Let\'s play VN!', 'time' => date('M d, Y'), 'type' => 'started', 'total_spectators' => rand(5, 100), 'thumbnail' => 'https://learnjapanese.moe/img/vn1.jpg', 'spectators' => $this->get_random_avatar(), 'is_dummy' => false],
            ['title'  => 'Karaoke live pika - #2', 'time' => date('M d, Y'), 'type' => 'ended', 'total_spectators' => rand(5, 100), 'thumbnail' => 'https://static.tvtropes.org/pmwiki/pub/images/white_album_2_tv_tropes_7081.jpg', 'spectators' => $this->get_random_avatar(), 'is_dummy' => false],
            ['title'  => 'Radio Night at 25:00', 'time' => date('M d, Y'), 'type' => 'started', 'total_spectators' => rand(5, 100), 'thumbnail' => 'https://pm1.aminoapps.com/8426/2bd716170401f11691c8c3b96f1d38c3d64c0534r1-2048-1261v2_hq.jpg', 'spectators' => $this->get_random_avatar(), 'is_dummy' => false],
            ['title'  => 'Pokenite Night Stream - Chilling bgm~', 'time' => date('M d, Y'), 'type' => 'started', 'total_spectators' => rand(5, 100), 'thumbnail' => 'https://media.wired.com/photos/611198a79561b7c69f078595/master/pass/games_pokemon-unite.jpg', 'spectators' => $this->get_random_avatar(), 'is_dummy' => false],
            ['title'  => 'Python Friendly Explanation (beginner - #01)', 'time' => date('M d, Y'), 'type' => 'soon', 'total_spectators' => rand(5, 100), 'thumbnail' => 'https://img-c.udemycdn.com/course/750x422/919038_3ae1_11.jpg', 'spectators' => $this->get_random_avatar(), 'is_dummy' => false],
            ['title'  => 'Develop Basic Control in Unity Platformer!', 'time' => date('M d, Y'), 'type' => 'started', 'total_spectators' => rand(5, 100), 'thumbnail' => 'https://i.stack.imgur.com/tqSR5.png', 'spectators' => $this->get_random_avatar(), 'is_dummy' => false],
            ['title'  => 'Night time with me, in Kabukicho Izakaya', 'time' => date('M d, Y'), 'type' => 'started', 'total_spectators' => rand(5, 100), 'thumbnail' => 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/16/c1/18/10/caption.jpg?w=1200&h=-1&s=1', 'spectators' => $this->get_random_avatar(), 'is_dummy' => false],
            ['title'  => 'NFS MH - Explore this horizon', 'time' => date('M d, Y'), 'type' => 'soon', 'total_spectators' => rand(5, 100), 'thumbnail' => 'https://news.xbox.com/en-us/wp-content/uploads/sites/2/2019/08/Reveal_week_1_night_escaping_cops_through_the_city.jpg?w=569', 'spectators' => $this->get_random_avatar(), 'is_dummy' => false],
            ['title'  => 'Okinawa Churaumi Aquarium', 'time' => date('M d, Y'), 'type' => 'ended', 'total_spectators' => rand(5, 100), 'thumbnail' => 'https://ohh.okinawa/wpdir/wp-content/uploads/2018/10/28edf4533771a2e2d61c2efb71328057.jpg', 'spectators' => $this->get_random_avatar(), 'is_dummy' => false],
            ['title'  => 'Studying Laravel Livewire - 1', 'time' => date('M d, Y'), 'type' => 'ended', 'total_spectators' => rand(5, 100), 'thumbnail' => 'https://cdn.devdojo.com/posts/images/June2020/what-is-livewire4.jpg?w=1280&h=720&fit=crop', 'spectators' => $this->get_random_avatar(), 'is_dummy' => false],
            ['title'  => 'About UI design', 'time' => date('M d, Y'), 'type' => 'started', 'total_spectators' => rand(5, 100), 'thumbnail' => 'https://images.squarespace-cdn.com/content/v1/5c439fd8266c07ff148f5765/1600913470294-NQVNUBEGXH78LK2ZVK2I/Top+20+Ecommerce+App+Inspiration+Ideas+%231-1.jpg', 'spectators' => $this->get_random_avatar(), 'is_dummy' => false],
            ['title'  => 'Setsuna Accoustic - VN PlayME', 'time' => date('M d, Y'), 'type' => 'soon', 'total_spectators' => rand(5, 100), 'thumbnail' => 'https://learnjapanese.moe/img/vn2.jpg', 'spectators' => $this->get_random_avatar(), 'is_dummy' => false],
        ]);
    }
}
