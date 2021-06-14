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

Route::prefix('api')->get("/api", function () {
    return "Api from base";
});


Route::prefix('api')->get("/api/test", function () {
    return "Api from test";
});
