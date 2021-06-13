<?php

use System\Core\Command;
use System\Inspiring;

require $system_path . "/" . "Inspire.php";
/**
 * Create console command
 * 
 * Here you can define your own console based command
 */


Command::set('inspire', function () {
    Command::comment(Inspiring::quote());
})->describe('Display an inspiration quote');


Command::set('ask', function () {
    $a = Command::ask("write your name: ");
    Command::danger($a);
})->describe('This is just a demo')->usage('ask');
