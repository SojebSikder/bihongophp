<?php

namespace System\Core;

use System\Database\Facade\DB;
use System\Helpers\ArrayHelper;
use System\Helpers\StringHelper;

/**
 * Eloquont Model (Experimantal)
 */
abstract class ORM
{
   private static $_instance = null;
   /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $_table;

   private $whereC = null;

   public function __construct()
   {
      // parent::__construct();

      // if (self::$_instance === null) {
      //    self::$_instance = new static;
      // }

      // Assign table name
      $this->_table = StringHelper::pluralize(2, strtolower(static::class));
   }

   private static function getInstance()
   {
      if (self::$_instance === null) {
         self::$_instance = new static;
      }
      return self::$_instance;
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

   /**
    * insert data
    */
   public static function create($objectData)
   {
      self::getInstance();
      $self = self::$_instance; //new static;
      $keys = ArrayHelper::arrayToString(array_keys($objectData));
      $values = ArrayHelper::arrayToStringWithQ(array_values($objectData));

      $data = DB::insert("insert $self->_table ($keys) values ($values)");
      return $data;
   }

   /**
    * update data
    */
   public static function update($objectData)
   {
      self::getInstance();
      $self = self::$_instance; //new static;
      $keys = '';
      $values = '';
      $set = '';

      foreach ($objectData as $key => $value) {
         $keys .= $key . ',';
         $values .= "'" . $value . "',";
         $set .= $key . "='" . $value . "',";
      }
      $set = trim($set, ',');

      $data = DB::update("update $self->_table set $set $self->whereC");
      return $data;
   }

   /**
    * save query data
    */
   public function save()
   {
      self::getInstance();
      $self = self::$_instance; // new static;

      $class = new \ReflectionClass($this);
      $tableName = $self->_table;

      $propsToImplode = [];

      foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) { // consider only public properties of the providen 
         $propertyName = $property->getName();

         if ($propertyName != "") {
            $propsToImplode[$propertyName] = $this->{$propertyName};
         }
      }

      /**
       * insert data
       */
      if ($self->whereC == null) {

         $sqlQuery = '';

         $keys = ArrayHelper::arrayToString(array_keys($propsToImplode));
         $values = ArrayHelper::arrayToStringWithQ(array_values($propsToImplode));

         $sqlQuery = "INSERT INTO  $tableName ($keys) VALUES  ($values)";

         $data = DB::insert($sqlQuery);
         return $data;
      }
      // update data
      else {

         $keys = '';
         $values = '';
         $set = '';

         foreach ($propsToImplode as $key => $value) {
            $keys .= $key . ',';
            $values .= "'" . $value . "',";
            $set .= $key . "='" . $value . "',";
         }
         $set = trim($set, ',');

         $data = DB::update("update $tableName set $set $self->whereC");
         return $data;
      }
   }
   /**
    * delete query data
    */
   public function delete()
   {
      self::getInstance();
      $self = self::$_instance; // new static;

      $tableName = $self->_table;

      /**
       * delete data
       */
      if ($self->whereC == null) {

         $sqlQuery = "DELETE FROM  $tableName";

         $data = DB::delete($sqlQuery);
         return $data;
      }
      // delete specific data
      else {
         $data = DB::delete("DELETE FROM $tableName $self->whereC");
         return $data;
      }
   }


   public static function morph(array $object)
   {
      $class = new \ReflectionClass(get_called_class()); // this is static method that's why i use get_called_class

      $entity = $class->newInstance();

      foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $prop) {
         if (isset($object[$prop->getName()])) {
            $prop->setValue($entity, $object[$prop->getName()]);
         }
      }

      $entity->initialize(); // soft magic

      return $entity;
   }
}
