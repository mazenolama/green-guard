<?php
	class Database {
		private static $dbName = 'b6ntd6lk9p2zyzsyloth-mysql.services.clever-cloud.com'; //'F0SaNkPCly' ;
		private static $dbHost = 'b6ntd6lk9p2zyzsyloth'; //'remotemysql.com' ;
		private static $dbUsername = 'ujy6l6sgmvvfm2br'; //'F0SaNkPCly';
		private static $dbUserPassword = 'alXHlXuO6DkkTtVAHSTF'; //'FJ2YKUB7gW';
		 
		private static $cont  = null;
		 
		public function __construct() {
			die('Init function is not allowed');
		}
		 
		public static function connect() {
		  // One connection through whole application
		  if ( null == self::$cont ) {     
        try {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e) {
          die($e->getMessage()); 
        }
		  }
		  return self::$cont;
		}
		 
		public static function disconnect() {
			self::$cont = null;
		}
	}
?>