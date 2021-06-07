<?php

/**
 * Eloquont Model
 */

abstract class ORM extends Model
{
   /**
    * The table associated with the model.
    *
    * @var string
    */
   //public $table;

   public function __construct()
   {
      parent::__construct();

      //self::$table = static::class;
   }

   /**
    * Fetch all data
    */
   public static function all($columns = ['*'])
   {

      $column = ArrayHelper::arrayToString($columns);
      $table = StringHelper::pluralize(2, strtolower(static::class));

      $data = DB::select("select $column from $table");
      return json_encode($data);
   }
}
