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
 * ->$route['default_controller'] = 'your site';
 */
$route['default_controller'] = 'Index'; //DO NOT DELETE THIS ROUTE NAME (default_controller)
$route['home'] = 'Index/home';
$route['te'] = 'Index/te';



?>