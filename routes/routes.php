<?php

/**
 * ___________
 * 
 * Setup Route
 * ___________
 * 
 * There are have some reserved routes:
 * $route['default_controller'] = 'welcome'; 
 * 
 * Example:
 * $route['path_name'] = 'Controller/Method'
 * If you not put method then home() method autometically invoke
 * 
 */


/**
 * __________________________________________________
 * 
 * DO NOT DELETE THIS ROUTE NAME (default_controller)
 * ___________________________________________________
 * Only can change value such as
 * ->$route['default_controller'] = 'Index';
 * change to
 * ->$route['default_controller'] = 'Controller/Method';
 */
$route['default_controller'] = 'IndexController'; //DO NOT DELETE THIS ROUTE NAME (default_controller)

$route['home'] = 'IndexController/home';
$route['test'] = 'IndexController/test';




$request = new Request();

Route::setRequest($request);

Route::get("/", function () {
    return "Hello World";
});

Route::get("/contact", function () {
    return "I'm from contact";
});
