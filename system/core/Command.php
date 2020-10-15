<?php
/**
 * Command Class
 */
require $system_path."/"."helpers/"."file_helper.php";

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
            self::danger($args."nd argument not found");
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
        global $argc, $argv, $application_folder;

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
                if($type == "controller"){
                    writeFile($application_folder."/"."controllers/".$name.".php", self::createController($name));
                    echo $name." controller created succesfully";
                break;
                }

                if($type == "model"){
                    writeFile($application_folder."/"."models/".$name.".php", self::createModel($name));
                    echo $name." model created succesfully";
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

    public static function text($text)
    {
        echo self::$white.$text."\n";
        echo self::$white; //white
    }

    public static function blue($text)
    {
        echo self::$blue.$text."\n";
        echo self::$white; //white
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
}



?>