<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public $data;

    public function __construct()
    {
        $this->data = [
            ['title'  => 'Let\'s watch together! Ariana Broadcast', 'time' => date('M d, Y')],
            ['title'  => 'Anisong piano cover - #3', 'time' => date('M d, Y')],
            ['title'  => 'NightyF - Graphic Design on Figma', 'time' => date('M d, Y')],
            ['title'  => 'Explore through everest mountain!', 'time' => date('M d, Y')],
            ['title'  => 'Geoguessr with Tantei Seia', 'time' => date('M d, Y')],
        ];
    }

    public function main()
    {
        $dummy = $this->data;
        return view('pages.main', ['dummy' => $dummy]);
    }
}
