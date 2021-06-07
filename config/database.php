<?php

/**
 * Database setup
 */

/**
 * Set Database connection which to use
 */
$active_db = env('DB_CONNECTION', 'mysql');

/**
 * Database Connections
 * 
 * You have to check out properly your perticular db driver 
 * installed on your device
 */
$config['db'] = [

	"mysql" => [
		"host" => env("DB_HOST", "127.0.0.1"),
		"username" => env("DB_USERNAME", "root"),
		"password" => env("DB_PASSWORD", ""),
		"dbname" => env("DB_DATABASE", "bihongophp"),
		'dbdriver' => 'mysqli',
	],

	"sqlite" => [
		"url" => env('DB_URL', "database/test.db"),
		'dbdriver' => 'sqlite',
	],

	"pgsql" => [
		"host" => env("DB_HOST", "127.0.0.1"),
		"port" => env("DB_PORT", 5432),
		"username" => env("DB_USERNAME", "root"),
		"password" => env("DB_PASSWORD", ""),
		"dbname" => env("DB_DATABASE", "bihongophp"),
		'dbdriver' => 'pgsql',
	]

];

/**
 * Migration Table. This use to track migrations
 */
$config['migrations'] = 'migration';

/**
 * Migration Directory Root
 */
$config['migration_path'] = 'database/migrations/';

/**
 * Seeder Directory ROOT
 */
$config['seed_path'] = 'database/seeds/';


/**
 * Important constants DO NOT TOUCH THIS
 */
defined("DB_HOST")
	or define("DB_HOST", $config['db']['mysql']['host']);
defined("DB_USER")
	or define("DB_USER", $config['db']['mysql']['username']);
defined("DB_PASS")
	or define("DB_PASS", $config['db']['mysql']['password']);
defined("DB_NAME")
	or define("DB_NAME", $config['db']['mysql']['dbname']);

/**
 * User can define constant here
 */
