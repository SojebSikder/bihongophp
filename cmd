#!/usr/bin/env php
<?php
/**
 * Command Console
 *
 * Create controller using this Command
 * make:controller ControllerName
 *
 * Create model using this Command
 * make:model ModelName
 */

use System\Core\Command;
use System\Core\DotEnv;

//Composer Autoload
require 'vendor/autoload.php';
//Initialize DotEnv
DotEnv::init();

require "config/config.php";
require "config/database.php";
require $system_path . "/" . "core/" . "Command.php";
require "routes/console.php";

Command::execute();
