<?php
/**
 * Main Model
 */

 class Model{
     protected $db = array();
     
     public function __construct(){
         global $config, $active_db;
        //$this->db = new Database();
        switch ($config['db'][$active_db]) {
            case 'mysqli':
                $driver = new MySQLAdapter();
                break;
            
            default:
                $driver = new MySQLAdapter();
                break;
        }
        $this->db = new Dbase($driver);
     }
 }
 
?>