<?php
/**
 * Main Model
 */

 class Model extends Builder{
     protected $db = array();
     
     public function __construct(){
        $this->db = $this->DBSwitcher();
     }

     /**
      * Switching database driver
      */
     public function DBSwitch($switch = false){
        return $this->DBSwitcher($switch);
     }
 }
 
?>