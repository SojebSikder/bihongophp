<?php

use System\Core\Route;
use App\Controllers\IndexController;
use System\Core\Request;

/**
 * ___________
 * 
 * Setup Api Route
 * ___________
 * 
 */




Route::get("/api", function () {
    return "Api from base";
});


Route::get("/api/test", function () {
    return "Api from test";
});
