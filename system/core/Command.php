<?php
/**
 * Command Class
 */
require $system_path."/"."helpers/"."file_helper.php";
class Command
{

    public static function execute()
    {
        global $argc, $argv, $application_folder;
        for ($i=1; $i < $argc; $i++) {

            $cmd = $argv[1];
            $sep1 = ':';
            $split = explode($sep1, $cmd);

            //make:controller HelloController

            $main = $split['0'];
            $type = $split['1'];
            $name = $argv[2];

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