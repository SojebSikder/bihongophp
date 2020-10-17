<?php
//namespace DB;
//include "AdapterInterface.php";
class SQLiteAdapter extends SQLite3 implements AdapterInterface{
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

    $this->link = $this->open($config['db']['sqlite']['dbname']);
    if(!$this->link){
      $this->error ="Connection fail".$this->link->connect_error;
      return false;
    }
  }
  
  /**
   * Create table
   */
  public function create_table(){
    $sql = "CREATE TABLE COMPANY
      (ID INT PRIMARY KEY NOT NULL,
      NAME TEXT NOT NULL, AGE INT NOT NULL, ADDRESS CHAR(50), SALARY REAL);";
  }

  // Select or Read data
  public function select($query){
    $result = $this->link->query($query) or die($this->link->error.__LINE__);
    if($result->num_rows > 0){
      return $result;
    } else {
      return false;
    }
  }
  
  // Insert data
  public function insert($query){
    $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
    if($insert_row){
      return $insert_row;
    } else {
      return false;
      }
  }
    
  // Update data
  public function update($query){
    $update_row = $this->link->query($query) or die($this->link->error.__LINE__);
    if($update_row){
      return $update_row;
    } else {
      return false;
      }
  }
    
  // Delete data
  public function delete($query){
    $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
    if($delete_row){
      return $delete_row;
    } else {
      return false;
      }
  }
 
}