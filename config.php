<?php
	define("db_host", "localhost");
	define("db_user", "root");
	define("db_pass", "");
	define("db_name", "student_udus");
	define("db_port", "3307");
	
	
	class db_connect{
		public $host = db_host;
		public $user = db_user;
		public $pass = db_pass;
		public $name = db_name;
		public $port = db_port;
		public $conn;
		public $error;
		
		
		public function connect(){
			$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name, $this->port);
			
			if(!$this->conn){
				$this->error="Fatal Error: Can't connect to database" . $this->connect->connect_error();
				return false;
			}
		}
		
	}
?>