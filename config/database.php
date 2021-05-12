<?php
if(basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)){header("Location: 404");}
    class Database extends PDO{

        private $engine;
        private $host;
        private $database;
        private $username;
        private $password;

        public function __construct()
        {
            $this->engine="mysql";
            $this->host="localhost";
            $this->database="codephp";
            $this->username="root";
            $this->password=''; 
            
            $dsn=$this->engine.":host=".$this->host.";dbname=".$this->database;
            parent::__construct($dsn,$this->username,$this->password);
        }        
    }