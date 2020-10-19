<?php
/**
 * Command Class
 */
require $system_path."/"."helpers/"."file_helper.php";

function current_migrate($row){
    global $system_path;
    //include $system_path."/core/dbloader.php";

    $db = new Database();
    $result = $db->select("SELECT * FROM migration ORDER BY id DESC")->fetch_assoc();
    return $result[$row];
}

function getBatch($row, $count){
    global $system_path;
    //include $system_path."/core/dbloader.php";

    $lastBatch = current_migrate('batch');

    $min = $lastBatch - $count;
    $db = new Database();
    
    $result = $db->select("SELECT * FROM migration WHERE batch = $min ORDER BY id DESC")->fetch_assoc();
    return $result[$row];
}

class Command
{
    public static $customCmd;
    public static $customCmdArray = array();
    public static $description = array();
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
    public static function args($args){
        global $argc, $argv, $application_folder;
        if(isset($argv[$args])){
            return $argv[$args];
        }else{
            self::danger($args." no. argument not found");
        }

    }

    /**
     * Set Custom Commands
     */
    public static function set($command, $callback)
    {
        global $argc, $argv, $application_folder;
        self::$customCmd = $command;

        self::$customCmdArray = [
            self::$customCmd => self::$customCmd
        ];

        if(self::$customCmdArray[self::$customCmd] == $argv[1]){
            $callback();
        }


        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;//new static;
    }

    /**
     * Describe Commands
     */

    public function describe($des)
    {
        self::$description[self::$customCmd] = $des;
        return $this;
    }

    public static function execute()
    {
        global $argc, $argv, $application_folder, $system_path, $config;

        self::set('version', function(){
            Command::comment("BihongoPHP Version 1.0.2");
        })->describe("Displays BihongoPHP version");

        self::set('test', function(){
            echo getBatch('migration', 1);
        });

        /**
         * Db:Seed
         */
        
        self::set('db:seed', function(){
            global $application_folder, $system_path, $config;

            require $system_path."/core/Database.php";
            require $system_path."/core/Database/Builder.php";
            require $system_path."/core/Database/Schema.php";

            require $system_path."/core/Database/Seeder.php";
            require $config['seed_path']."DatabaseSeeder.php";

            $dbseeder = new DatabaseSeeder();
            $dbseeder->run();

            Command::success("Database seeding completed successfully");
        })->describe('Database seeding command');

        /**
         * Db migrate
         */
        self::set('migrate', function(){
            global $argc, $argv, $application_folder, $system_path, $config;

            include $system_path."/core/dbloader.php";
            require $config['migration_path'].current_migrate('migration').".php";
            if(isset($argv[2])){
                //find current migrations
                $class = current_migrate('class');
                $test = new $class();
                $method = $argv[2];
                $test->$method();
                //end that
                self::success("$method Migration");
            }else{     
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
        self::set('migrate:rollback', function(){
            global $argc, $argv, $application_folder, $system_path, $config;

            include $system_path."/core/dbloader.php";

            if(isset($argv[2])){
                require $config['migration_path'].getBatch('migration', $argv[2]).".php";
                //find current migrations
                $class = getBatch('migration', $argv[2]);
                $test = new $class();
                $test->down();
                //end that
                self::success("Migration  reversed");
            }else{
                require $config['migration_path'].getBatch('migration', 1).".php";
                //find current migrations
                $class = getBatch('class', 1);
                $test = new $class();
                $test->down();
                //end that
                self::success("Migration reversed");
            }
        })->describe('Database reverse migrate command');


        /**
         * Display Help
         */
        if(isset($argv[1])){
   
            if($argv[1] == "help"){
                if(isset($argv[2])){
                    self::comment('Description:');
                    echo "  ".self::$description[$argv[2]]."\n";
                    self::comment('Usage:');
                    echo "  ".$argv[2]."\n";
                }else{
                    self::comment('Description:');
                    echo "  Diplays help for a command\n";
                    self::comment('Usage:');
                    echo "  help [tropic]\n";
                }
            }

            /**
             * Predefined Command
             */
           /* if($argv[1] == "migrate"){
                require $system_path."/core/Database.php";
                require $system_path."/core/Database/Builder.php";
                require $system_path."/core/Database/Schema.php";
                require $config['migration_path'].current_migrate('migration').".php";
                if(isset($argv[2])){
                    //find current migrations
                    $class = current_migrate('class');
                    $test = new $class();
                    $method = $argv[2];
                    $test->$method();
                    //end that
                    self::success("$method Migration: ");
                }else{     
                    //find current migrations
                    $class = current_migrate('class');
                    $test = new $class();
                    $test->up();
                    //end that
                    self::success("Created Migration: ");
                }     
            } */

        }


        /**
         * Predefined Command
         */
        for ($i=1; $i < $argc; $i++) {

            $cmd = $argv[1];
            $sep1 = ':';
            $split = explode($sep1, $cmd);

            //make:controller HelloController

            if(isset($split['0'])){
                $main = $split['0'];
            }
            if(isset($split['1'])){
                $type = $split['1'];
            }
            if(isset($argv[2])){
                $name = $argv[2];
            }
            
            if($main == "make"){
                /**
                 * Create Controller
                 */
                if($type == "controller"){
                    writeFile($application_folder."/"."controllers/".$name.".php", self::createController($name));
                    self::success($name." controller created succesfully");
                break;
                }

                /**
                 * Create Model
                 */
                if($type == "model"){
                    writeFile($application_folder."/"."models/".$name.".php", self::createModel($name));
                    self::success($name." model created succesfully");
                break;
                }

                /**
                 * Create Migration
                 */
                if($type == "migration"){
                    if(isset($name)){      
                        $time = time();//date('F_j_Y_g_i_a', time());
                        writeFile($config['migration_path'].$time."-".$name.".php", self::createMigration($name, $time."-".$name, $name, $time));
                        self::success("Created Migration: ".$time."-".$name);
                    }else{
                        self::danger("2nd Argument not found");
                    }
                break;
                }
                /**
                 * Seed
                 */
                if($type == "seed"){
                    if(isset($name)){      
                        writeFile($config['seed_path'].$name.".php", self::createSeed($name));
                        self::success("Seeder created successfully");
                    }else{
                        self::danger("2nd Argument not found");
                    }
                break;
                }
                
            }
        }


    }


    /**
     * Output Functions
     */
    public static function comment($text)
    {
        echo self::$yellow.$text."\n";
        echo self::$white; //white
    }

    public static function success($text)
    {
        echo self::$green.$text."\n";
        echo self::$white; //white
    }

    public static function danger($text)
    {
        echo self::$red.$text."\n";
        echo self::$white; //white
    }

    public static function line($text)
    {
        echo self::$white.$text."\n";
        echo self::$white; //white
    }

    public static function info($text)
    {
        echo self::$blue.$text."\n";
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
    public static function createController($controllerName){
        $data ='<?php 

class '.$controllerName.' extends Controller{
    public function __construct(){
        parent::__construct();
    }

    public function home(){
        $this->load->view("home");
    }
}
?>
';

        return $data;
    
    }

    public static function createModel($modelName){
        $data ='<?php

class '.$modelName.' extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function dataList($query){
        return $this->db->select($query);
    }
}
        
        
?>
';

        return $data;
    }


    public static function createMigration($migrationName, $version, $class, $onlyVersion){
        global $system_path, $config;
        $tableName = $config['migrations'];
        /**
         * Create Database
         */
        include $system_path."/core/dbloader.php";

        $db = new Database();


        Schema::create(function(Builder $table){
            global $config;
            $tableName = $config['migrations'];

            $table->create_table($tableName, true, [
                'id' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
                'class' => 'VARCHAR(255) NOT NULL',
                'migration' => 'VARCHAR(255) NOT NULL',
                'version' => 'VARCHAR(255) NOT NULL',
                'batch' => 'INT(11) NOT NULL AUTO_INCREMENT ,  PRIMARY KEY (batch)'
            ]);

        });

        
        $db->insert("INSERT INTO $tableName (migration, class, version) 
        VALUES('$version', '$class', '$onlyVersion')");

         //end That


        $data ='<?php

class '.$migrationName.'
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
    public static function createSeed($seedName){

        $data ='<?php

class '.$seedName.' extends Seeder
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

    


}





?>