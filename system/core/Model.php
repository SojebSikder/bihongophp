<?php

/**
 * Main Model
 */

class Model extends Builder
{
   public $db = array();

   public function __construct()
   {
      $this->db = $this->DBSwitcher();
   }

   /**
    * Switching database driver
    */
   public function DBSwitch($switch = false)
   {
      return $this->DBSwitcher($switch);
   }
}
