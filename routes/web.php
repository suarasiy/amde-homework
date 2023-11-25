<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('/', [MainController::class, 'main']);
// });

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'main');
});
