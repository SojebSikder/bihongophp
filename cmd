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
require "config/config.php";
require "config/database.php";
require $system_path."/"."core/"."Command.php";
require "config/console.php";

Command::execute();

