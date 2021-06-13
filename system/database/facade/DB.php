<?php

namespace System\Database\Facade;

use System\Core\Model;

/**
 * DB facade
 */
class DB extends Model
{
    /**
     * 
     * @var DB
     */
    private static $instance;

    public function __construct()
    {
        parent::__construct();
    }
    private static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    /**
     * Select query
     */
    public static function select($query)
    {
        return DB::getInstance()->db->select($query);
    }

    /**
     * SelectOne query
     */
    public static function selectOne($query)
    {
        return DB::getInstance()->db->selectOne($query);
    }

    /**
     * insert query
     */
    public static function insert($query)
    {
        return DB::getInstance()->db->insert($query);
    }

    /**
     * update query
     */
    public static function update($query)
    {
        return DB::getInstance()->db->update($query);
    }

    /**
     * delete query
     */
    public static function delete($query)
    {
        return DB::getInstance()->db->delete($query);
    }

    /**
     * Statement query
     */
    public static function statement($query)
    {
        return DB::getInstance()->db->statement($query);
    }
}
