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
    // $time = date('F_j_Y_g_i_a', time());
    $time = date('Y_j_g_i_s_u', time());
    return $time;
    //return "Hello from simple route";
});

Route::get("/test", [IndexController::class, 'test']);

/**
 * Login Register Route
 */

Route::get("/login", [App\Controllers\RegisterController::class, "login"]);
Route::get("/register", [App\Controllers\RegisterController::class, "register"]);
Route::get("/logout", [App\Controllers\RegisterController::class, "logout"]);
        