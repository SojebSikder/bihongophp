<?php

/**
 * Load Framework
 */

use System\Core\Autoload;
use System\Core\Config;
use System\Core\Request;
use System\Core\Response;
use System\Core\Route;
use System\Core\Server;

/**
 * Setup Files
 */
//require "config/config.php";
require $base . "config/database.php";
require $base . "routes/web.php";
require $base . "config/email.php";
/**
 * Exception Files
 */
require $base . $system_path . "/core/Exception.php";
/**
 * Autoload Core
 */
//Composer Autoload
//require 'vendor/autoload.php';
//Custom Autoload
Autoload::init();
//Initialize DotEnv
//DotEnv::init();
//Initialize Config
Config::init();


/**
 * BihongoPHP Version
 */
const B_VERSION = '2.0.0';

/**
 * Pass request
 */
$request = new Request();
$response = new Response();

Route::setRequest($request);
Route::setResponse($response);

/**
 * Server Setup
 */
Server::init();
