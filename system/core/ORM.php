<?php

/**
 * Eloquont Model (Experimantal)
 */
abstract class ORM extends Model
{
   public static $_instance = null;
   /**
    * The table associated with the model.
    *
    * @var string
    */
   public $_table;

   private $whereC = null;

   public function __construct()
   {
      parent::__construct();

      // if (self::$_instance === null) {
      //    self::$_instance = new static;
      // }

      // Assign table name
      $this->_table = StringHelper::pluralize(2, strtolower(static::class));
   }

   public static function getInstance()
   {
      if (self::$_instance === null) {
         self::$_instance = new static;
      }
   }

   /**
    * where clause
    */
   public static function where($key, $value)
   {
      self::getInstance();
      $self = self::$_instance; // new static;
      if ($self->whereC == null) {
         $self->whereC = "where $key = '$value'";
      } else {
         $self->whereC .= " and $key = '$value'";
      }
      return $self;
   }

   /**
    * Or where clause
    */
   public static function orWhere($key, $value)
   {
      self::getInstance();
      $self = self::$_instance; // new static;
      if ($self->whereC == null) {
         $self->whereC = "where $key = '$value'";
      } else {
         $self->whereC .= " or $key = '$value'";
      }
      return $self;
   }


   /**
    * Fetch query data
    */
   public function get($columns = ['*'])
   {
      self::getInstance();
      $self = self::$_instance; // new static;
      $column = ArrayHelper::arrayToString($columns);
      $data = DB::select("select $column from $self->_table $self->whereC");

      //echo $self->whereC;
      return $data;
   }

   /**
    * Fetch all data
    */
   public static function all($columns = ['*'])
   {
      self::getInstance();
      $self = self::$_instance; //new static;
      if (is_array($columns)) {
         $column = ArrayHelper::arrayToString($columns);
      } else {
         $column = $columns;
      }

      $data = DB::select("select $column from $self->_table");

      return $data;
   }
}
