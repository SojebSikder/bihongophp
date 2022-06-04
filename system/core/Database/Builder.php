<?php

namespace System\Core\Database;

use System\Database\Dbase;
use System\Database\Drivers\MySQLAdapter;
use System\Database\Drivers\PostgreSQLAdapter;
use System\Database\Drivers\SQLiteAdapter;

/**
 * Builder
 */
class Builder
{
    protected $db;

    public $table = '';

    public function __construct()
    {
        $this->connection();
    }

    public function connection()
    {
        $this->db = $this->DBSwitcher();
    }

    public function DBSwitcher($switch = false)
    {
        global $config, $active_db;
        //$this->db = new Database();

        if ($switch == false) {
            $dbsw = $config['db'][$active_db]['dbdriver'];
        } else {
            $dbsw = $switch;
        }

        switch ($dbsw) {
            case 'mysqli':
                $driver = new MySQLAdapter();
                break;

            case 'sqlite':
                $driver = new SQLiteAdapter();
                break;

            case 'pgsql':
                $driver = new PostgreSQLAdapter();
                break;

            default:
                $driver = new MySQLAdapter();
                break;
        }
        return $this->db = new Dbase($driver);
    }

    public function create_table($table, $if_not_exist = true, $attributes = array())
    {
        if ($if_not_exist == true) {
            $attr = '';
            foreach ($attributes as $attribute => $value) {
                $attr .= $attribute . " " . $value . ",";
            }
            $attr = rtrim($attr, ',' . PHP_EOL);
            $sql = "CREATE TABLE IF NOT EXISTS $table ($attr) ;"; //ENGINE = InnoDB
            $this->db->insert($sql);

            $this->table = $table;

            return $this;
        } else {
            $attr = '';
            foreach ($attributes as $attribute => $value) {
                $attr .= $attribute . " " . $value . ",";
            }
            $attr = rtrim($attr, ',' . PHP_EOL);
            $sql = "CREATE TABLE $table ($attr) ;"; //ENGINE = InnoDB
            $this->db->insert($sql);

            $this->table = $table;

            return $this;
        }
    }

    public function alter_table($table, $attributes = array())
    {
        $attr = '';
        foreach ($attributes as $attribute => $value) {
            $sql = "ALTER TABLE $table CHANGE $attribute $value;";
            $this->db->insert($sql);
            $this->table = $table;
        }


        return $this;
    }

    public function dropIfExists($table)
    {
        $sql = "DROP TABLE IF EXISTS $table";
        $this->db->delete($sql);

        return $this;
    }

    public function drop($table)
    {
        $sql = "DROP TABLE $table";
        $this->db->delete($sql);

        return $this;
    }


    public function add_key($key, $primary = true)
    {
        if ($primary == true) {
            $sql = "ALTER TABLE $this->table CHANGE $key $key INT(11) NOT NULL AUTO_INCREMENT, add PRIMARY KEY ($key)";
            $this->db->update($sql);

            return $this;
        }
    }
}
