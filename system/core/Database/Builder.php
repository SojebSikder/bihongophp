<?php
/**
 * Builder
 */
class Builder
{
    protected $db = array();

    public $table ='';

    public function __construct(){
        $this->connection();
    }

    public function connection(){
        $this->db = $this->DBSwitcher();
    }

    public function DBSwitcher(){
        global $config, $active_db;
        //$this->db = new Database();
        switch ($config['db'][$active_db]['dbdriver']) {
            case 'mysqli':
                $driver = new MySQLAdapter();
                break;
                
            case 'sqlite':
                $driver = new SQLiteAdapter();
                break;

            case 'mssql':
                $driver = new MSSQLAdapter();
                break;

            case 'mongodb':
                $driver = new MongoDBAdapter();
                break;
            
            default:
                $driver = new MySQLAdapter();
                break;
        }
        return $this->db = new Dbase($driver);
    }

    public function create_table($table, $if_not_exist = true, $attributes = array()){
        if($if_not_exist == true){
            $attr = '';
            foreach ($attributes as $attribute => $value) {
                $attr .= $attribute." ".$value.",";
            }
            $attr = rtrim($attr,','.PHP_EOL);
            $sql = "CREATE TABLE IF NOT EXISTS $table ($attr) ENGINE = InnoDB;";
            $this->db->link->query($sql);

            $this->table = $table;

            return $this;
        }else{   
            $attr = '';
            foreach ($attributes as $attribute => $value) {
                $attr .= $attribute." ".$value.",";
            }
            $attr = rtrim($attr,','.PHP_EOL);
            $sql = "CREATE TABLE $table ($attr) ENGINE = InnoDB;";
            $this->db->link->query($sql);

            $this->table = $table;

            return $this;
        }
    }

    public function dropIfExists($table){
        $sql = "DROP TABLE IF EXISTS $table";
        $this->db->link->query($sql);

        return $this;
    }

    public function drop($table){
        $sql = "DROP TABLE $table";
        $this->db->link->query($sql);

        return $this;
    }


	public function add_key($key, $primary = true)
	{
        if($primary == true){
            $sql = "ALTER TABLE $this->table CHANGE $key $key INT(11) NOT NULL AUTO_INCREMENT, add PRIMARY KEY ($key)";
            $this->db->link->query($sql);

            return $this;
        }
        
	}

}
