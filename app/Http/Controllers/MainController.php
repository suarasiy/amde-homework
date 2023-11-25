<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function main()
    {
        $data = [
            ['id' => 1, 'message' => 'example 1'],
            ['id' => 2, 'message' => 'example 2'],
            ['id' => 3, 'message' => 'example 3'],
            ['id' => 4, 'message' => 'example 4'],
            ['id' => 5, 'message' => 'example 5'],
        ];
        return view('pages.main', ['dummy' => $data]);
    }
}
