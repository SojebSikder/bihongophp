<?php
/**
 * Database setup
 */

/**
 * Set Database connection which to use
 */
$active_db = 'mysqli';

/**
 * Database Connections
 */
$config['db'] = [
	"mysqli" => [
		"host" => "localhost", 					//DB Host (Changeable)
		"username" => "root", 					//DB user (Changeable)
		"password" => "", 						//DB Password (Changeable)
		"dbname" => "test", 					//DB name (Changeable)
		'dbdriver' => 'mysqli'
	],
	"sqlite" => [
		"url" => "test.db",						//DB url. Use as your requirement
		'dbdriver' => 'sqlite'
	]
 ];
/**
 * Migration Directory Root
 */
$config['migration_path'] = $application_folder.'/database/migrations/';
/**
 * Seeder Directory ROOT
 */
$config['seed_path'] = $application_folder.'/database/seeds/';


/**
 * Important constants DO NOT TOUCH THIS
 */
defined("DB_HOST")
	or define("DB_HOST", $config['db']['mysqli']['host']);
defined("DB_USER")
	or define("DB_USER", $config['db']['mysqli']['username']);
defined("DB_PASS")
	or define("DB_PASS", $config['db']['mysqli']['password']);
defined("DB_NAME")
    or define("DB_NAME", $config['db']['mysqli']['dbname']);
    
/**
 * User can define constant here
 */