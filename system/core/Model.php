<?php
/**
 * Main Model
 */

 class Model{
     protected $db = array();
     
     public function __construct(){
         global $config, $active_db;
        //$this->db = new Database();
        switch ($config['db'][$active_db]['dbdriver']) {
            case 'mysqli':
                $driver = new MySQLAdapter();
                break;

            case 'mssql':
                $driver = new MSSQLAdapter();
                break;

            case 'mongodb':
                $driver = new MongoDBAdapter();
                break;
            
            default:
                $driver = new MySQLAdapter();
                break;
        }
        $this->db = new Dbase($driver);
     }
 }
 
?>