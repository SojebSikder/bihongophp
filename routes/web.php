<?php

use System\Core\Route;
use App\Controllers\IndexController;
use System\Core\Request;
use System\Core\Route3;
use System\Helpers\StringHelper;

/**
 * ___________
 * 
 * Setup Route
 * ___________
 * 
 */


Route::get("/", [IndexController::class, 'index']);


Route::get("/hello/test/{id}", function () {
    return "Hello World ";
});


// $rt = new Route3();
// $rt->add("/sojeb/{id}/{value}","test.php");



Route::get("/test", [IndexController::class, 'test']);

/**
 * Login Register Route
 */

Route::get("/login", [App\Controllers\RegisterController::class, "login"]);
Route::get("/register", [App\Controllers\RegisterController::class, "register"]);
Route::get("/logout", [App\Controllers\RegisterController::class, "logout"]);
