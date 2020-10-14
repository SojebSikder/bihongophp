<?php
/**
* Command Console
*
* Create controller using this Command
* make:controller ControllerNameController
*
* Create model using this Command
* make:model ModelNameModel
*/
require "config/config.php";
require $system_path."/"."core/"."Command.php";
require "config/Console.php";

Command::execute();

?>