<?php
require $system_path."/"."Inspire.php";
use system\Inspiring;
/**
 * Create console command
 * 
 * Here you can define your own console based command
 */


Command::set('inspire', function(){
    Command::comment(Inspiring::quote());
})->describe('Display an inspiration qoute');


Command::set('ask', function(){
    $a = Command::ask("write your name: ");
    Command::info($a);
})->describe('This is just a demo');

