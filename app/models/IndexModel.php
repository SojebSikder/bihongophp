<?php

class IndexModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function select($query){
        return $this->db->select($query);
    }
}

