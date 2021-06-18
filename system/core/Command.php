<?php

namespace System\Core;

/**
 * Command Class
 */

use DatabaseSeeder;
use System\Core\Autoload;
use System\Core\Config;
use System\Core\Database;
use System\Core\Database\Builder;
use System\Core\Database\Schema;
use System\Core\Perser2;
use System\Helpers\File;

require "vendor/autoload.php";
Autoload::init();
const B_VERSION = '3.0.0';

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

class Command
{
    public static $customCmd;
    public static $customCmdArray = array();
    public static $description = array();
    public static $usage = array();
    public static $_instance = null;

    /**
     * Command Promt Color
     */
    public static $red = "\033[31m";
    public static $green = "\033[32m";
    public static $yellow = "\033[33m";
    public static $blue = "\033[34m";
    public static $white = "\033[37m";


    /**
     * Accass Command Prompt Arguments
     */
    public static function args($args)
    {
        global $argc, $argv, $application_folder;
        if (isset($argv[$args])) {
            return $argv[$args];
        } else {
            self::danger($args . " no. argument not found");
        }
    }
    /**
     * Execute an external program
     */
    public static function exec($command, $output = true)
    {
        if ($output == true) {
            return shell_exec($command);
        } else if ($output == false) {
            return exec($command);
        }
        return self::$_instance; //$this;
    }

    /**
     * Set Custom Commands
     */
    public static function set($command, $callback)
    {
        global $argc, $argv, $application_folder;
        self::$customCmd = $command;

        self::$customCmdArray[self::$customCmd] = self::$customCmd;

        if (self::$customCmdArray[self::$customCmd] == $argv[1]) {
            $callback();
        }


        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance; //new static;
    }

    /**
     * Describe Commands
     */

    public function describe($des)
    {
        self::$description[self::$customCmd] = $des;
        return $this;
    }

    public function usage($des)
    {
        self::$usage[self::$customCmd] = $des;
        return $this;
    }

    public static function execute()
    {
        global $argc, $argv, $application_folder, $system_path, $config;

        /**
         * Predefined Command
         */

        self::set('version', function () {
            Command::comment("BihongoPHP Version " . B_VERSION);
        })->describe("Displays BihongoPHP version");

        self::set('-v', function () {
            Command::comment("BihongoPHP Version " . B_VERSION);
        })->describe("Displays BihongoPHP version");

        self::set('serve', function () {
            Command::exec('php -S localhost:8000');
        })->describe("Serve the application on the PHP development server");


        /**
         * Create react scaffolding
         */
        self::set('ui:react', function () {
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
        self::set('make:auth', function () {
            global $application_folder, $system_path, $config;

            self::createAuth();
            Command::success("Authentication created");
        })->describe("Create Authentication");

        /**
         * Server Down
         */
        self::set('down', function () {

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
        self::set('up', function () {
            unlink("storage/down");
            if (!file_exists("storage/down")) {
                Command::success("Application is now live");
            }
        })->describe("Exit maintenance mode")->usage("up");

        /**
         * Clear page cache
         */
        self::set('clear:cache', function () {
            Perser2::clearCache();
            Command::success("Cache cleared successfully");
        })->describe("Clear page cache");

        /**
         * Db:Seed
         */

        self::set('db:seed', function () {
            global $application_folder, $system_path, $config;
            require $config['seed_path'] . "DatabaseSeeder.php";

            $dbseeder = new DatabaseSeeder();
            $dbseeder->run();

            Command::success("Database seeding completed successfully");
        })->describe('Database seeding command');

        /**
         * Db migrate
         */
        self::set('migrate', function () {
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
                self::success("$method Migration");
            } else {
                //find current migrations
                $class = current_migrate('class');
                $test = new $class();
                $test->up();
                //end that
                self::success("Created Migration");
            }
        })->describe('Database migrate command');

        /**
         * Migrate:rollback (Constructing)
         */
        self::set('migrate:rollback', function () {
            global $argc, $argv, $application_folder, $system_path, $config;

            require $system_path . "/core/dbloader.php";

            if (isset($argv[2])) {
                require $config['migration_path'] . getBatch($config['migrations'], $argv[2]) . ".php";
                //find current migrations
                $class = getBatch($config['migrations'], $argv[2]);
                $test = new $class();
                $test->down();
                //end that
                self::success("Migration  reversed");
            } else {
                require $config['migration_path'] . getBatch($config['migrations'], 1) . ".php";
                //find current migrations
                $class = getBatch('class', 1);
                $test = new $class();
                $test->down();
                //end that
                self::success("Migration reversed");
            }
        })->describe('Database reverse migrate command');



        /**
         * Create Controller
         */
        self::set('make:controller', function () {
            global $application_folder;

            $name = Command::args(2);
            File::writeFile($application_folder . "/" . "controllers/" . $name . ".php", self::createController($name));
            self::success($name . " controller created succesfully");
        })->describe("Create controller")->usage("make:controller [ControllerName]");

        /**
         * Create Model
         */
        self::set('make:model', function () {
            global $application_folder;

            $name = Command::args(2);
            File::writeFile($application_folder . "/" . "models/" . $name . ".php", self::createModel($name));
            self::success($name . " model created succesfully");
        })->describe("Create model")->usage("make:model [ModelName]");


        /**
         * Create Migration
         */
        self::set('make:migration', function () {
            global $application_folder, $config;

            $name = Command::args(2);

            if (isset($name)) {
                $time = time(); //date('F_j_Y_g_i_a', time());
                File::writeFile($config['migration_path'] . $time . "-" . $name . ".php", self::createMigration($name, $time . "-" . $name, $name, $time));
                self::success("Created Migration: " . $time . "-" . $name);
            } else {
                self::danger("2nd Argument not found");
            }
        })->describe("Create migration")->usage("make:migration [MigrationName]");


        /**
         * Seed
         */
        self::set('make:seed', function () {
            global $application_folder, $config;

            $name = Command::args(2);

            if (isset($name)) {
                File::writeFile($config['seed_path'] . $name . ".php", self::createSeed($name));
                self::success("Seeder created successfully");
            } else {
                self::danger("2nd Argument not found");
            }
        })->describe("Create seed")->usage("make:seed [SeedName]");;


        /**
         * list
         */
        self::set('list', function () {
            $cmd = self::$customCmdArray;

            $i = 0;
            foreach ($cmd as $key => $value) {
                $i++;
                if (array_key_exists($key, self::$description) && array_key_exists($key, self::$usage)) {
                    echo $i . ")" . $key . " -----------> " . self::$description[$key] . " -------> " . self::$usage[$key] . "\n";
                } else if (array_key_exists($key, self::$description)) {
                    echo $i . ")" . $key . " -----------> " . self::$description[$key] . "\n";
                } else if (array_key_exists($key, self::$usage)) {
                    echo $i . ")" . $key . " -------> " . self::$usage[$key] . "\n";
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
                    self::comment('Description:');
                    echo "  " . self::$description[$argv[2]] . "\n";
                    self::comment('Usage:');
                    if (array_key_exists($argv[2], self::$usage)) {
                        echo "  " . self::$usage[$argv[2]] . "\n";
                    } else {
                        echo "  " . $argv[2] . "\n";
                    }
                } else {
                    self::comment('Description:');
                    echo "  Diplays help for a command\n";
                    self::comment('Usage:');
                    echo "  help [tropic]\n";
                }
            }
        }
    }


    /**
     * Output Functions
     */
    public static function comment($text)
    {
        echo self::$yellow . $text . "\n";
        echo self::$white; //white
    }

    public static function success($text)
    {
        echo self::$green . $text . "\n";
        echo self::$white; //white
    }

    public static function danger($text)
    {
        echo self::$red . $text . "\n";
        echo self::$white; //white
    }

    public static function line($text)
    {
        echo self::$white . $text . "\n";
        echo self::$white; //white
    }

    public static function info($text)
    {
        echo self::$blue . $text . "\n";
        echo self::$white; //white
    }
    /**
     * Get value from command prompt
     */
    public static function ask($text)
    {
        return readline($text);
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
