<?php

namespace System\Core;

use System\Core\Autoload;
use System\Core\Config;
use System\Core\Request;
use System\Core\Response;
use System\Core\Route;
use System\Core\Server;

/**
 * Application
 */
class Application
{
    /**
     * BihongoPHP Version
     */
    public static $version = "3.0.0";

    /**
     * Initialize Application
     */
    public static function init()
    {
        global $base, $system_path;
        /**
         * Setup Files
         */
        //require "config/config.php";
        // require $base . "config/database.php";
        require $base . "routes/web.php";
        require $base . "routes/api.php";
        // require $base . "config/email.php";
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
    }
}
