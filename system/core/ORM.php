<?php

/**
 * Main Model
 */

abstract class ORM extends Model
{

   public function __construct()
   {
      parent::__construct();
   }


   /**
    * Eloquont Model
    */
   public static function all()
   {
      return "All data";
   }
}
