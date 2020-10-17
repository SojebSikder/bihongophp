<?php
//namespace DB;
//include "AdapterInterface.php";
class sqlite extends SQLite3
{
  function __construct(){
    global $config;
    $this->open($config['db']['sqlite']['url']);
  }
}

class SQLiteAdapter implements AdapterInterface{
 public $host   = DB_HOST;
 public $user   = DB_USER;
 public $pass   = DB_PASS;
 public $dbname = DB_NAME;
 
 
 public $link;
 public $error;
 
 public function __construct(){
  $this->connectDB();
 }
 
  private function connectDB(){
    global $config;

    $db = new sqlite();
    $this->link = $db ;

    if(!$this->link){
      $this->error ="Connection fail ".$this->link->lastErrorMsg();
      return false;
    }else{
      return true;
    }
  }
  
  /**
   * Create table
   */
  public function create_table(){
    $sql = "CREATE TABLE COMPANY
      (ID INT PRIMARY KEY NOT NULL,
      NAME TEXT NOT NULL, AGE INT NOT NULL, ADDRESS CHAR(50), SALARY REAL);";

      $ret = $this->link->exec($sql);
      if(!$ret){
        echo $this->error;
      }else{
        echo "Table create successfully";
      }
      $this->link->close();
  }

  // Select or Read data
  public function select($query){
    $result = $this->link->query($query) or die($this->link->error.__LINE__);
    if($result){
      return $result;
    } else {
      return false;
    }
  }
  
  // Insert data
  public function insert($query){
    $insert_row = $this->link->exec($query) or die($this->link->error.__LINE__);
    if($insert_row)
    {
      return $insert_row;
    }else
    {
      return false;
    }
    $this->link->close();
  }
    
  // Update data
  public function update($query){
    $update_row = $this->link->exec($query) or die($this->link->error.__LINE__);
    if($update_row){
      return $update_row;
    } else {
      return false;
    }
      $this->link->close();
  }
    
  // Delete data
  public function delete($query){
    $delete_row = $this->link->exec($query) or die($this->link->error.__LINE__);
    if($delete_row){
      return $delete_row;
    }else{
      return false;
    }
      $this->link->close();
  }
 
}