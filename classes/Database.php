<?php

class Database{
    
    //TODO USE THE DB CONSTANT IN THE CONSTRUCTOR
    //TODO BETTER WAY TO GET INFO FROM THE DB
    
    private $connection;
    private static $instance = null;
    public $result = [];
    public $query;
    
    private function __construct() {
        $this->connection = new mysqli('localhost', 'root', '', 'final');
        if($this->connection->connect_error){
            echo "Database error";
        }
    }
    
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    public function query($sql){
        $this->query = $this->connection->query($sql);
    }
        
    public function selectQuery($sql){
        $this->query = $this->connection->query($sql);
        $result = [];
        while($row = $this->query->fetch_assoc()){
            $result[] = $row;
        }
        return $result;
    }
    
    // Check for affected rows
    public function checkQuery($sql){
        $this->selectQuery($sql);
        return $this->connection->affected_rows;
    }
    
}