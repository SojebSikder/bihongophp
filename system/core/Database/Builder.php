<?php
/**
 * Builder
 */
class Builder
{
    protected $db = array();

    public function __construct(){
        $this->connection();
    }

    public function connection(){
        $this->db = new Database();
    }

    public function create_table($table, $if_not_exist = true, $attributes = array()){
        if($if_not_exist == true){

        }else{   
            $attr = '';
            foreach ($attributes as $attribute => $value) {
                $attr .= $attribute." ".$value.",";
            }
            $attr = rtrim($attr,','.PHP_EOL);
            $sql = "CREATE TABLE $table ($attr) ENGINE = InnoDB;";
            $this->db->link->query($sql);
        }
    }

    public function dropIfExists($table){
        $sql = "DROP TABLE IF EXISTS $table";
        $this->db->link->query($sql);
    }


	public function add_key($key, $primary = FALSE)
	{
        
	}

}
