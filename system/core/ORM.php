<?php

/**
 * Eloquont Model
 */

abstract class ORM extends Model
{

   public function __construct()
   {
      parent::__construct();
   }

   /**
    * Fetch all data
    */
   public static function all($columns = ['*'])
   {

      $column = ArrayHelper::arrayToString($columns);

      $data = DB::select("select $column from addresses");
      return json_encode($data);
   }
}
