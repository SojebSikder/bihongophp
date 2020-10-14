<?php
/**
 * Command Class
 */
require $system_path."/"."helpers/"."file_helper.php";
class Command
{
    public static $customCmd;
    public static $description;
    public static $_instance = null;

    /**
     * Command Promt Color
     */
    public static $red = "\033[31mRed";
    public static $green = "\033[32mGreen";
    public static $yellow = "\033[33mYellow";
    public static $blue = "\033[34mBlue";
    public static $white = "\033[37m";


    public static function comment($text)
    {
        echo self::$yellow.$text; //yellow
        echo self::$white; //white
    }

    public static function success($text)
    {
        echo self::$green.$text; //yellow
        echo self::$white; //white
    }

    public static function danger($text)
    {
        echo self::$red.$text; //yellow
        echo self::$white; //white
    }

    public static function text($text)
    {
        echo self::$white.$text; //yellow
        echo self::$white; //white
    }

    public static function blue($text)
    {
        echo self::$blue.$text; //yellow
        echo self::$white; //white
    }

    public static function set($command, $callback)
    {
        global $argc, $argv, $application_folder;
        self::$customCmd = $command;

        if(self::$customCmd == $argv[1]){
            $callback();
        }

        if (self::$_instance === null) {
            self::$_instance = new self;
        } 

        return self::$_instance;//new static;
        
    }

    public function describe($des)
    {
        self::$description = $des;
        return $this;
    }

    public static function execute()
    {
        global $argc, $argv, $application_folder;
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