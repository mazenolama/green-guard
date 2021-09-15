<?php 
  class Database {
    // DB Params
    private $host = 'b6ntd6lk9p2zyzsyloth-mysql.services.clever-cloud.com';//remotemysql.com
    private $db_name = 'b6ntd6lk9p2zyzsyloth';//F0SaNkPCly
    private $username = 'ujy6l6sgmvvfm2br';//F0SaNkPCly
    private $db_pass = 'alXHlXuO6DkkTtVAHSTF';//FJ2YKUB7gW
    private $conn;
    

    // DB Connect
    public function connect() {
      $this->conn = null;

      try 
      { 
        //mysql://ujy6l6sgmvvfm2br:alXHlXuO6DkkTtVAHSTF@b6ntd6lk9p2zyzsyloth-mysql.services.clever-cloud.com:3306/b6ntd6lk9p2zyzsyloth
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