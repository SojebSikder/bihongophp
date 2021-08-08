<?php

use System\Core\Command;
use System\Inspiring;

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



Command::set('test', function () {
    Command::exec('cd public && php -S localhost:8000');
})->describe('This is test server')->usage('test');
