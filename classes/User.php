<?php

class User{
    
    public $userID;
    public $userData = [];
    private $validate;
    
    public function __construct(){
        
       $this->validate = new Validate();
       foreach ($_POST as $key => $value) {
           $this->userData[$key] = $value; 
       }
   }
    
    
    public function register(){

        if($this->validate->checkRegister($this->userData['first_name'], $this->userData['last_name'], $this->userData['email'], $this->userData['password'], $this->userData['rpassword'])){
            $hashedPass = $this->hashPass($this->userData['password']);
            Database::getInstance()->query("INSERT INTO users (email,first_name,last_name,password) VALUES ('{$this->userData['email']}','{$this->userData['first_name']}','{$this->userData['last_name']}','{$hashedPass}')");
            header('Location:index.php?type=user&action=login');
        }  
    }
    
    public function login(){
        
        if($this->validate->checkLogin($this->userData['email'], $this->userData['password'])){
            $this->getUserID($this->userData['email']);
            $_SESSION['loggedIn'] = true;
            $_SESSION['userId'] = $this->userID;
            $this->timeLoggedIn();
            header('Location:index.php?type=user&action=profile');
        }
    }
    
    public function logout(){
        
        $this->timeLoggedOut();
        session_destroy();
        header("Location: index.php");   
    }
    
    public function editProfile(){
        
        if($this->validate->checkEditForm($this->userData['first_name'], $this->userData['last_name'], $this->userData['password'], $this->userData['editPassword'])){
            $userID = $_SESSION['userId'];
            $NewhashedPass = $this->hashPass($this->userData['editPassword']);
            Database::getInstance()->query("UPDATE users SET first_name ='{$this->userData['first_name']}', last_name ='{$this->userData['last_name']}', password ='{$NewhashedPass}' WHERE id ='$userID'");
            header('Location:index.php?type=user&action=profile');
        }
    }
    
    public function timeLoggedIn(){
        
        $time = date('Y-m-d H:i:s');
        $db = Database::getInstance();
        if($db->checkQuery("SELECT user_id FROM logs WHERE user_id = '$this->userID'")){
            $db->query("UPDATE logs SET time_logged = '$time' WHERE user_id = '$this->userID'");
        }else{
            $db->query("INSERT INTO logs (user_id,time_logged) VALUES ('$this->userID','$time')");
        }
    }
    
    public function timeLoggedOut(){
        
        $time = date('Y-m-d H:i:s');
        $userID = $_SESSION['userId'];
        Database::getInstance()->query("UPDATE logs SET time_loggedout = '$time' WHERE user_id = '$userID'");
    }
    

    public function hashPass($password){
        
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
   public function getUserID($email){
       
       $db = Database::getInstance();
       $result = $db->selectQuery("SELECT id FROM users WHERE email = '$email'");
       $this->userID =  $result[0]['id'];
   }
   
}