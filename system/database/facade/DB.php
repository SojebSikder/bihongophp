<?php

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
    public static function getInstance()
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
        return DB::getInstance()->select($query);
    }
    public static function _select($query)
    {
        return self::$db->select($query);
    }
    /**
     * End Select
     */
}
