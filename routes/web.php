<?php

use System\Core\Route;
use App\Controllers\IndexController;
use System\Core\Request;

/**
 * ___________
 * 
 * Setup Route
 * ___________
 * 
 */

Route::get("/", function () {
    return view('home.te');
});

Route::get("/home", [IndexController::class, 'index']);
Route::get("/test", [IndexController::class, 'test']);
