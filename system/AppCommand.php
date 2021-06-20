<?php

namespace System;

use System\Core\Command;

/**
 * App console command
 * 
 * Reserved for app
 */

use DatabaseSeeder;
use System\Core\Application;
use System\Core\Autoload;
use System\Core\Config;
use System\Core\Database;
use System\Core\Database\Builder;
use System\Core\Database\Schema;
use System\Core\Perser2;
use System\Helpers\File;

require "vendor/autoload.php";
Autoload::init();

define("B_VERSION", Application::$version);

function current_migrate($row)
{
    global $system_path, $config;

    $db = new Database();
    $table = $config['migrations'];
    $result = $db->select("SELECT * FROM $table ORDER BY id DESC")->fetch_assoc();
    return $result[$row];
}

function getBatch($row, $count)
{
    global $system_path, $config;

    $lastBatch = current_migrate('batch');

    $min = $lastBatch; //- $count;
    $db = new Database();
    $table = $config['migrations'];
    $result = $db->select("SELECT * FROM $table WHERE batch = $min ORDER BY id DESC")->fetch_assoc();
    return $result[$row];
}

class AppCommand
{

    public static function execute()
    {
        global $argc, $argv, $application_folder, $system_path, $config;

        /**
         * Predefined Command
         */

        Command::set('version', function () {
            Command::comment("BihongoPHP Version " . B_VERSION);
        })->describe("Displays BihongoPHP version");

        Command::set('-v', function () {
            Command::comment("BihongoPHP Version " . B_VERSION);
        })->describe("Displays BihongoPHP version");

        Command::set('serve', function () {
            global $argv;
            if (isset($argv[2])) {
                Command::exec('php -S localhost:' . $argv[2]);
            } else {
                Command::exec('php -S localhost:8000');
            }
        })->describe("Serve the application on the PHP development server");


        /**
         * Create react scaffolding
         */
        Command::set('ui:react', function () {
            global $application_folder, $system_path, $config;

            // Copy files
            copy($system_path . "/template/react/resources/js/index.js", "resources/js/index.js");
            copy($system_path . "/template/react/package.json", "package.json");
            copy($system_path . "/template/react/.babelrc", ".babelrc");
            copy($system_path . "/template/react/config.js", "config.js");
            copy($system_path . "/template/react/webpack.config.js", "webpack.config.js");
            Command::success("File copied successfully");
            // Run npm install command with package
            $verbose = shell_exec("npm install --save-dev webpack webpack-cli webpack-dev-server path html-webpack-plugin eslint eslint-loader @babel/core @babel/node @babel/preset-env @babel/preset-react babel-loader style-loader css-loader sass-loader node-sass image-webpack-loader file-loader @babel/plugin-proposal-class-properties react react-dom");
            Command::info($verbose);

            Command::info(shell_exec('npm run webpack'));
            Command::info(shell_exec('npm start'));
        })->describe("Create react scaffolding");

        /**
         * make:auth
         */
        Command::set('make:auth', function () {
            global $application_folder, $system_path, $config;

            self::createAuth();
            Command::success("Authentication created");
        })->describe("Create Authentication");

        /**
         * Server Down
         */
        Command::set('down', function () {

            //initialize config for time-zone
            Config::init();

            $server_info = '{
            "time": "' . date("F j, Y, g:i a", time()) . '",
            "message": null,
            "retry": null,
            "allowed": []
        }';
            file_put_contents("storage/down", $server_info);
            if (file_exists("storage/down")) {
                Command::comment("Application is in now maintenance mode");
            }
        })->describe("Put the application in maintenance mode")->usage("down");
        /**
         * Server Up
         */
        Command::set('up', function () {
            unlink("storage/down");
            if (!file_exists("storage/down")) {
                Command::success("Application is now live");
            }
        })->describe("Exit maintenance mode")->usage("up");

        /**
         * Clear page cache
         */
        Command::set('cache:clear', function () {
            Perser2::clearCache();
            Command::success("Cache cleared successfully");
        })->describe("Clear page cache");

        /**
         * Db:Seed
         */

        Command::set('db:seed', function () {
            global $application_folder, $system_path, $config;
            require $config['seed_path'] . "DatabaseSeeder.php";

            $dbseeder = new DatabaseSeeder();
            $dbseeder->run();

            Command::success("Database seeding completed successfully");
        })->describe('Database seeding command');

        /**
         * Db migrate
         */
        Command::set('migrate', function () {
            global $argc, $argv, $application_folder, $system_path, $config;

            require $system_path . "/core/dbloader.php";
            require $config['migration_path'] . current_migrate('migration') . ".php";
            if (isset($argv[2])) {
                //find current migrations
                $class = current_migrate('class');
                $test = new $class();
                $method = $argv[2];
                $test->$method();
                //end that
                Command::success("$method Migration");
            } else {
                //find current migrations
                $class = current_migrate('class');
                $test = new $class();
                $test->up();
                //end that
                Command::success("Created Migration");
            }
        })->describe('Database migrate command');

        /**
         * Migrate:rollback (Constructing)
         */
        Command::set('migrate:rollback', function () {
            global $argc, $argv, $application_folder, $system_path, $config;

            require $system_path . "/core/dbloader.php";

            if (isset($argv[2])) {
                require $config['migration_path'] . getBatch($config['migrations'], $argv[2]) . ".php";
                //find current migrations
                $class = getBatch($config['migrations'], $argv[2]);
                $test = new $class();
                $test->down();
                //end that
                Command::success("Migration  reversed");
            } else {
                require $config['migration_path'] . getBatch($config['migrations'], 1) . ".php";
                //find current migrations
                $class = getBatch('class', 1);
                $test = new $class();
                $test->down();
                //end that
                Command::success("Migration reversed");
            }
        })->describe('Database reverse migrate command');



        /**
         * Create Controller
         */
        Command::set('make:controller', function () {
            global $application_folder;

            $name = Command::args(2);
            File::writeFile($application_folder . "/" . "controllers/" . $name . ".php", self::createController($name));
            Command::success($name . " controller created succesfully");
        })->describe("Create controller")->usage("make:controller [ControllerName]");

        /**
         * Create Model
         */
        Command::set('make:model', function () {
            global $application_folder;

            $name = Command::args(2);
            File::writeFile($application_folder . "/" . "models/" . $name . ".php", self::createModel($name));
            Command::success($name . " model created succesfully");
        })->describe("Create model")->usage("make:model [ModelName]");


        /**
         * Create Migration
         */
        Command::set('make:migration', function () {
            global $application_folder, $config;

            $name = Command::args(2);

            if (isset($name)) {
                $time = time(); //date('F_j_Y_g_i_a', time());
                File::writeFile($config['migration_path'] . $time . "-" . $name . ".php", self::createMigration($name, $time . "-" . $name, $name, $time));
                Command::success("Created Migration: " . $time . "-" . $name);
            } else {
                Command::danger("2nd Argument not found");
            }
        })->describe("Create migration")->usage("make:migration [MigrationName]");


        /**
         * Seed
         */
        Command::set('make:seed', function () {
            global $application_folder, $config;

            $name = Command::args(2);

            if (isset($name)) {
                File::writeFile($config['seed_path'] . $name . ".php", self::createSeed($name));
                Command::success("Seeder created successfully");
            } else {
                Command::danger("2nd Argument not found");
            }
        })->describe("Create seed")->usage("make:seed [SeedName]");;


        /**
         * list
         */
        Command::set('list', function () {
            $cmd = Command::$customCmdArray;

            $i = 0;
            foreach ($cmd as $key => $value) {
                $i++;
                if (array_key_exists($key, Command::$description) && array_key_exists($key, Command::$usage)) {
                    echo $i . ")" . $key . " -----------> " . Command::$description[$key] . " -------> " . Command::$usage[$key] . "\n";
                } else if (array_key_exists($key, Command::$description)) {
                    echo $i . ")" . $key . " -----------> " . Command::$description[$key] . "\n";
                } else if (array_key_exists($key, Command::$usage)) {
                    echo $i . ")" . $key . " -------> " . Command::$usage[$key] . "\n";
                } else {
                    echo $i . ")" . $key . "\n";
                }
            }
        })->describe("Displays command list")->usage("list");

        /**
         * Display Help
         */
        if (isset($argv[1])) {

            if ($argv[1] == "help") {
                if (isset($argv[2])) {
                    Command::comment('Description:');
                    echo "  " . Command::$description[$argv[2]] . "\n";
                    Command::comment('Usage:');
                    if (array_key_exists($argv[2], Command::$usage)) {
                        echo "  " . Command::$usage[$argv[2]] . "\n";
                    } else {
                        echo "  " . $argv[2] . "\n";
                    }
                } else {
                    Command::comment('Description:');
                    echo "  Diplays help for a command\n";
                    Command::comment('Usage:');
                    echo "  help [tropic]\n";
                }
            }
        }
    }


    /**
     * Functions
     */
    public static function createController($controllerName)
    {
        $data = '<?php 

namespace App\Controllers;

class ' . $controllerName . ' extends Controller{
    public function __construct(){
        parent::__construct();
    }

    public function home(){
        return view("home");
    }
}

';

        return $data;
    }

    public static function createModel($modelName)
    {
        $data = '<?php

use System\Core\ORM;

class ' . $modelName . ' extends ORM{
    public function __construct(){
        parent::__construct();
    }
}
        

';

        return $data;
    }


    public static function createMigration($migrationName, $version, $class, $onlyVersion)
    {
        global $system_path, $config;
        $tableName = $config['migrations'];
        /**
         * Create Database
         */
        // require $system_path . "/core/dbloader.php";

        // $db = new Database();


        // Schema::create(function (Builder $table) {
        //     global $config;
        //     $tableName = $config['migrations'];

        //     $table->create_table($tableName, true, [
        //         'id' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
        //         'class' => 'VARCHAR(255) NOT NULL',
        //         'migration' => 'VARCHAR(255) NOT NULL',
        //         'version' => 'VARCHAR(255) NOT NULL',
        //         'batch' => 'INT(11) NOT NULL AUTO_INCREMENT ,  PRIMARY KEY (batch)'
        //     ]);
        // });


        // $db->insert("INSERT INTO $tableName (migration, class, version) 
        // VALUES('$version', '$class', '$onlyVersion')");

        //end That


        $data = '<?php

use System\Core\Database\Builder;
use System\Core\Database\Schema;

class ' . $migrationName . '
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
';

        return $data;
    }

    /**
     * Create Seed
     */
    public static function createSeed($seedName)
    {

        $data = '<?php

use System\Core\Database\Seeder;

class ' . $seedName . ' extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    }
}
';

        return $data;
    }

    public static function createAuth()
    {
        global $application_folder, $system_path, $config;

        $routes = '
/**
 * Login Register Route
 */

Route::get("/login", [App\Controllers\RegisterController::class, "login"]);
Route::get("/register", [App\Controllers\RegisterController::class, "register"]);
Route::get("/logout", [App\Controllers\RegisterController::class, "logout"]);
        ';

        /**
         * Create view file
         */
        copy($system_path . "/template/auth/views/login.te.php", "resources/views/login.te.php");
        copy($system_path . "/template/auth/views/register.te.php", "resources/views/register.te.php");

        /**
         * Create route
         */
        file_put_contents("routes/web.php", $routes, FILE_APPEND);
        /**
         * create controller/Model
         */
        copy($system_path . "/template/auth/Controller/RegisterController.php", $application_folder . "/Controllers/RegisterController.php");
        copy($system_path . "/template/auth/Models/Register.php", $application_folder . "/Models/Register.php");
    }
}
