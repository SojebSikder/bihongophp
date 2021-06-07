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

   public $table;


   public function __construct()
   {
      parent::__construct();

      $this->table = StringHelper::pluralize(2, strtolower(static::class));
   }

   /**
    * Fetch all data
    */
   public static function all($columns = ['*'])
   {
      $self = new static;
      $column = ArrayHelper::arrayToString($columns);
      $data = DB::select("select $column from $self->table");

      return json_encode($data);
   }
}
