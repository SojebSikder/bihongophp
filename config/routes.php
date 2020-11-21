<?php
/**
 * Setup Route
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
 * DO NOT DELETE THIS ROUTE NAME (default_controller)
 * Only can change value such as
 * ->$route['default_controller'] = 'Index';
 * change to
 * ->$route['default_controller'] = 'Controller/Method';
 */
$route['default_controller'] = 'IndexController'; //DO NOT DELETE THIS ROUTE NAME (default_controller)

$route['home'] = 'IndexController/home';
$route['te'] = 'IndexController/te';
/**
 * A Callback example
 */
$route['callback'] = function($essen){

    $essen->benchmark->mark('start');
    //Render callback page
    $essen->load->view('callback');
    $essen->benchmark->mark('end');
	echo "Page render in ".$essen->benchmark->elapsed_time('start', 'end');
};
