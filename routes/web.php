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

/**
 * Login Register Route
 */

Route::get("/login", [App\Controllers\RegisterController::class, "login"]);
Route::get("/register", [App\Controllers\RegisterController::class, "register"]);
Route::get("/logout", [App\Controllers\RegisterController::class, "logout"]);
        