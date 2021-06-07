<?php
/**
 * Load Framework
 */

/**
 * Setup Files
 */
//require "config/config.php";
require "config/database.php";
require "routes/routes.php";
require "config/email.php";

/**
 * Exception Files
 */
require $system_path."/core/Exception.php";

/**
 * Autoload Core
 */
//Composer Autoload
require 'vendor/autoload.php';

//Custom Autoload
Autoload::init();

//Initialize Config
Config::init();

/**
 * BihongoPHP Version
 */
const B_VERSION = '1.0.8';

/**
 * Server Setup
 */
Server::init();


