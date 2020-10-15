<?php
/**
 * Enable/Disable Migrations
 * 
 * Migrations are disabled by default for security reasons.
 * You should enable migrations whenever you intend to do a schema migration
 * and disable it back when you're done.
 */
$config['migration_enabled'] = TRUE;

/*
|--------------------------------------------------------------------------
| Migration Type
|--------------------------------------------------------------------------
|
*/
$config['migration_type'] = 'timestamp';

/*
|--------------------------------------------------------------------------
| Migrations table
|--------------------------------------------------------------------------
*/
$config['migration_table'] = 'migrations';


/*
|--------------------------------------------------------------------------
| Migrations version
|--------------------------------------------------------------------------
|
*/

$config['migration_version'] = 20121031100537;

/*
|--------------------------------------------------------------------------
| Migrations Path
|--------------------------------------------------------------------------
|
| Path to your migrations folder.
| Typically, it will be within your application path.
| Also, writing permission is required within the migrations path.
|
*/
$config['migration_path'] = ROOT.$application_folder.'\/migrations/';
