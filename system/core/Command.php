<?php
/**
 * Command Class
 */
require "vendor/autoload.php";
Autoload::init();
const B_VERSION = '1.0.7';

function current_migrate($row){
    global $system_path;

    $db = new Database();
    $result = $db->select("SELECT * FROM migration ORDER BY id DESC")->fetch_assoc();
    return $result[$row];
}

function getBatch($row, $count){
    global $system_path;

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

        self::$customCmdArray[self::$customCmd] = self::$customCmd;

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

        self::set('version', function(){
            Command::comment("BihongoPHP Version ".B_VERSION);
        })->describe("Displays BihongoPHP version");

        self::set('-v', function(){
            Command::comment("BihongoPHP Version ".B_VERSION);
        })->describe("Displays BihongoPHP version");

       
        /**
         * make:auth
         */
        self::set('make:auth', function(){
            global $application_folder, $system_path, $config;

            self::createAuth();
            Command::success("Authentication created");
            
        })->describe("Create Authentication");

        /**
         * Clear page cache
         */
        self::set('cache:clear', function(){
            Perser2::clearCache();
            Command::success("Cache cleared successfully");
        })->describe("Clear page cache");

        /**
         * Db:Seed
         */
        
        self::set('db:seed', function(){
            global $application_folder, $system_path, $config;
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

            require $system_path."/core/dbloader.php";
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

            require $system_path."/core/dbloader.php";

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
         * Create Controller
         */
        self::set('make:controller', function(){
            global $application_folder;
            
            $name = Command::args(2);
            File::writeFile($application_folder."/"."controllers/".$name.".php", self::createController($name));
            self::success($name." controller created succesfully");
        })->describe("Create controller")->usage("make:controller [ControllerName]");
        
        /**
         * Create Model
         */
        self::set('make:model', function(){
            global $application_folder;
            
            $name = Command::args(2);
            File::writeFile($application_folder."/"."models/".$name.".php", self::createModel($name));
            self::success($name." model created succesfully");
        })->describe("Create model")->usage("make:model [ModelName]");


        /**
         * Create Migration
         */
         self::set('make:migration', function(){
            global $application_folder, $config;
            
            $name = Command::args(2);

            if(isset($name)){      
                $time = time();//date('F_j_Y_g_i_a', time());
                File::writeFile($config['migration_path'].$time."-".$name.".php", self::createMigration($name, $time."-".$name, $name, $time));
                self::success("Created Migration: ".$time."-".$name);
            }else{
                self::danger("2nd Argument not found");
            }

        })->describe("Create migration")->usage("make:migration [MigrationName]");;


        /**
         * Seed
         */
        self::set('make:seed', function(){
            global $application_folder, $config;
            
            $name = Command::args(2);
            
            if(isset($name)){      
                File::writeFile($config['seed_path'].$name.".php", self::createSeed($name));
                self::success("Seeder created successfully");
            }else{
                self::danger("2nd Argument not found");
            }
        })->describe("Create seed")->usage("make:seed [SeedName]");;


        /**
         * list
         */
        self::set('list', function(){
            $cmd = self::$customCmdArray;
            foreach ($cmd as $key => $value) {
                echo $key."\n";
            }
        })->describe("Displays command list")->usage("list");;

        /**
         * Display Help
         */
        if(isset($argv[1])){
   
            if($argv[1] == "help"){
                if(isset($argv[2])){
                    self::comment('Description:');
                    echo "  ".self::$description[$argv[2]]."\n";
                    self::comment('Usage:');
                    if(array_key_exists($argv[2], self::$usage)){
                        echo "  ".self::$usage[$argv[2]]."\n";
                    }else{
                        echo "  ".$argv[2]."\n";
                    }
                    
                }else{
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
        

';

        return $data;
    }


    public static function createMigration($migrationName, $version, $class, $onlyVersion){
        global $system_path, $config;
        $tableName = $config['migrations'];
        /**
         * Create Database
         */
        require $system_path."/core/dbloader.php";

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

    public static function createAuth(){
        global $application_folder, $system_path, $config;

        require $system_path."/core/dbloader.php";
        Schema::create(function(Builder $table){

            $table->create_table('users', true, [
                'id' => 'INT(11) NOT NULL AUTO_INCREMENT ,  PRIMARY KEY (id)',
                'username' => 'VARCHAR(255) NOT NULL',
                'email' => 'VARCHAR(255) NOT NULL',
                'password' => 'VARCHAR(255) NOT NULL'
            ]);

        });



        $login ='<!DOCTYPE html>
<html>
<head>
    <base href="<?php echo ROOT ?>">
    <meta charset="UTF-8">
    <link rel="icon" href="<?php echo ICON ?>" type="image/png" sizes="16x16">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Welcome to <?php echo TITLE ?></title>

    <link rel="stylesheet" href="<?php echo ASSET ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ASSET ?>css/material.css">

    <script src="<?php echo ASSET ?>js/jquery.min.js"></script>
    <script src="<?php echo ASSET ?>js/jsoj.js"></script>
    <script src="<?php echo ASSET ?>js/material.js"></script>
</head>
<body>


<div class="container">
<div class="m-justify"> 
<div class="m-card">
<div class="m-card-body">


<?php echo Form::open("login",[
    "method"=>"post",
        "class"=> "form-signin"
    ]); ?>

    <h5 class="m-center">Login</h5>


    <div class="m-input-group">
    <input type="text" name="username" class="text-dark m-form-control" autofocus>
    <label>Username or Email</label>
    </div>
    
    <div class="m-input-group">
    <input type="password" name="password" class="text-dark m-form-control">
    <label>Password</label>
    </div>

    <a class="float-left" href="recover">Forget Account?</a>
    <p class="float-right">Don\'t have an account? <a href="register">Register</a></p>
    <input class="m-btn waves-effect m-btn-primary m-btn-block" name="submit" type="submit" value="Sign in">

    </form>
    
</div>
</div>
</div>
</div>
        
        ';

        $register = '<!DOCTYPE html>
<html>
<head>
    <base href="<?php echo ROOT ?>">
    <meta charset="UTF-8">
    <link rel="icon" href="<?php echo ICON ?>" type="image/png" sizes="16x16">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Welcome to <?php echo TITLE ?></title>

    <link rel="stylesheet" href="<?php echo ASSET ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ASSET ?>css/material.css">

    <script src="<?php echo ASSET ?>js/jquery.min.js"></script>
    <script src="<?php echo ASSET ?>js/jsoj.js"></script>
    <script src="<?php echo ASSET ?>js/material.js"></script>
</head>
<body>


<div class="container">
    <div class="m-justify">
    <div class="m-card">
    <div class="m-card-body">

    <?php echo formOpen("register",[
        "method"=>"post",
        "class"=> "form-signin"
    ]); ?>

        <h3 class="m-center">Register</h3>
        <p class="m-center">It\'s free!</p>


        <div class="m-input-group">
        <input type="text" name="username" class="text-dark m-form-control" autofocus>
        <label>Name</label>
        </div>

        <div class="m-input-group">
        <input type="text" name="email" class="text-dark m-form-control">
        <label>Email address</label>
        </div>

        <div class="m-input-group">
        <input type="password" name="password" class="text-dark m-form-control">
        <label>Password</label>
        </div>

        
        <input class="float-left m-hidden" id="psk" type="button" ng-click="showPass()">
        <label class="float-left" for="psk">Show Password</label>

        <p class="float-right">Already have an account? <a href="login">Login</a></p>
        <input class="m-btn waves-effect m-btn-primary m-btn-block" name="submit" type="submit" value="Register">
        </form>
        
    </div>
    </div>
    </div>
</div>
        ';

        $controller = '<?php 
session_start(); //this will start session

class RegisterController extends Controller{
    public function __construct(){
        parent::__construct();
    }


    public function register(){

        $userModel = $this->load->model("RegisterModel");

        if($this->input->post("submit")){
            $username = Format::Stext($this->input->post("username"));
            $email = Format::Stext($this->input->post("email"));
            $password = password_hash(Format::Stext($this->input->post("password")), PASSWORD_DEFAULT);

            $exe = $userModel->register($username, $email, $password);

            if($exe){
                Format::goto("login");
            }
        }

        $this->load->view("register");
    }

    public function login(){
        $userModel =$this->load->model("RegisterModel");

        if($this->input->post("submit")){
            $username = Format::Stext($this->input->post("username"));
            $password = Format::Stext($this->input->post("password"));

            $exe = $userModel->login($username, $password);

            echo "Login successfully";	
            Format::goto("home");
        }

        $this->load->view("login");
    }

    public function logout(){
        session_destroy();
        Format::goto("home");
    }


}
        ';

        $model = '<?php

class RegisterModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function register($username, $email, $password){
        $result = $this->db->insert("INSERT INTO users (username, email, password) 
        VALUES(\'$username\', \'$email\', \'$password\')");

        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function login($username, $password){
        $state = $this->db->select("SELECT * FROM users WHERE username=\'$username\'");

        if($state){
            if(mysqli_num_rows($state) > 0){
                foreach ($state as $row) {
                    if(password_verify($password, $row[\'password\'])){
                        $_SESSION[\'username\'] = $row[\'username\'];
                        $_SESSION[\'email\'] = $row[\'email\'];
                    }else{
                        return false;
                    }
                }
            }
        }else{
            return false;
        }
    }
}        
        ';

        $routes = '
/**
 * Login Register Route
 */
$route["login"] = "RegisterController/login";
$route["register"] = "RegisterController/register";
$route["logout"] = "RegisterController/logout";
        ';

        /**
         * Create view file
         */
        File::writeFile($application_folder."/"."views/login.php", $login);
        File::writeFile($application_folder."/"."views/register.php", $register);

        /**
         * Create route
         */
        file_put_contents("config/routes.php", $routes, FILE_APPEND);
        /**
         * create controller/Model
         */
        file_put_contents($application_folder."/"."controllers/RegisterController.php", $controller, FILE_APPEND);
        file_put_contents($application_folder."/"."models/RegisterModel.php", $model, FILE_APPEND);

    }

    


}



