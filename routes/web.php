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

Route::get("/", [IndexController::class, 'index']);

Route::get("/simple", function () {
    return "Hello from simple route";
});

Route::get("/test", [IndexController::class, 'test']);
        