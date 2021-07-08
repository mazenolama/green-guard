<?php 
  class Database {
    // DB Params
    private $host = 'remotemysql.com';
    private $db_name = 'F0SaNkPCly';
    private $username = 'F0SaNkPCly';
    private $db_pass = 'ky3HtIoH0Y@';
    private $conn;
    

    // DB Connect
    public function connect() {
      $this->conn = null;

      try 
      { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->db_pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } 
      
      catch(PDOException $e) 
      {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }
  /*
    define('DB_HOST','127.0.0.1 ');
    define('DB_NAME','id16684157_greengurad');
    define('DB_USERNAME','id16684157_greenguard');
    define('DB_PASS','Mazen000000@');
      
      try 
      { 
          $conn = new PDO("mysql:host=" .DB_HOST . ";dbname=" . DB_NAME,
          DB_USERNAME,DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'utf8'"));
          
      }
       catch(PDOException $e) 
      {
        echo 'Connection Error: ' . $e->getMessage();
      }*/