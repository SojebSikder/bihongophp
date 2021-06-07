<?php
//namespace DB;
//include "AdapterInterface.php";

class PostgreSQLAdapter implements AdapterInterface
{
  public $host;
  public $port;
  public $dbname;
  public $credentials;


  public $link;
  public $error;

  public function __construct()
  {
    $this->connectDB();
  }

  private function connectDB()
  {
    global $config, $active_db;
    $this->host = "host = " . $config['db'][$active_db]['host'];
    $this->port   = "port = " . $config['db'][$active_db]['port'];
    $this->dbname = "dbname = " . $config['db'][$active_db]['dbname'];
    $this->credentials = "user = " . $config['db'][$active_db]['username'] . " password=" . $config['db'][$active_db]['password'];

    $this->link = pg_connect("$this->host $this->port $this->dbname $this->credentials");
    if (!$this->link) {
      $this->error = "Connection fail";
      return false;
    } else {
      echo "successfully";
    }
  }

  // Select or Read data
  public function select($query)
  {
    $result = pg_query($this->link, $query) or die($this->link->error . __LINE__);
    if ($result->num_rows > 0) {
      return $result;
    } else {
      return false;
    }
  }

  // Insert data
  public function insert($query)
  {
    $insert_row = pg_query($this->link, $query) or die($this->link->error . __LINE__);
    if ($insert_row) {
      return $insert_row;
    } else {
      return false;
    }
  }

  // Update data
  public function update($query)
  {
    $update_row = pg_query($this->link, $query) or die($this->link->error . __LINE__);
    if ($update_row) {
      return $update_row;
    } else {
      return false;
    }
  }

  // Delete data
  public function delete($query)
  {
    $delete_row = pg_query($this->link, $query) or die($this->link->error . __LINE__);
    if ($delete_row) {
      return $delete_row;
    } else {
      return false;
    }
  }
}
