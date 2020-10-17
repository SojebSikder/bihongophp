<?php
/**
 * Main Model
 */

 class Model extends Builder{
     protected $db = array();
     
     public function __construct(){
        $this->db = $this->DBSwitcher();
     }
 }
 
?>