<?php

class App {


    public function loadPage() {
        
        if(!isset($_SESSION['loggedIn'])){
            $this->loadLoginRegister();
        }
        else{
            $this->loadUserContent();
        }    
    }
    
    public function loadLoginRegister() {
        
        if ($this->checkUrlKeyIsSet('type', 'action')) {
            
            if ($this->checkUrlKeyValue('user', 'register')) {
                require_once 'views/register.php';
            }
            
            elseif ($this->checkUrlKeyValue('user', 'login')) {
                require_once 'views/login.php';
                
            } else {
                require_once 'views/404.html';
            }
            
        } else {
            require_once 'views/login.php';
        }
    }
    
    public function loadUserContent() {
        
        if ($this->checkUrlKeyIsSet('type', 'action')) {
            
            if ($this->checkUrlKeyValue('user', 'profile')) {
                require_once 'views/profile.php';
            }
            
            elseif ($this->checkUrlKeyValue('content', 'index') || $this->checkUrlKeyValue('dir', 'open') ) {
                require_once 'views/content.php';
            }
            
            
            
            elseif ($this->checkUrlKeyValue('dir', 'create')) {
                require_once 'views/createFolder.php';
            }
            
            elseif($this->checkUrlKeyValue('dir', 'rename') || $this->checkUrlKeyValue('file', 'rename')){
                 require_once 'views/renameForm.php';
            }
            
            elseif($this->checkUrlKeyValue('dir', 'delete') || $this->checkUrlKeyValue('file', 'delete')){
                 require_once 'views/deleteWarning.php';
            }
            
            
            elseif ($this->checkUrlKeyValue('user', 'history')) {
                require_once 'views/history.php';
            } 
            
            elseif ($this->checkUrlKeyValue('user', 'logout')) {
                $user = new User();
                $user->logout();
                
            } 
            else {
                require_once 'views/404.html';
            }
            
        } else {
            require_once 'views/profile.php';
        }
    }
    

    public function checkUrlKeyValue($key1, $key2) {
        
        if ($_GET['type'] == $key1 && $_GET['action'] == $key2) {
            return true;
        }
    }

    public function checkUrlKeyIsSet($key1, $key2) {
        
        if (isset($_GET[$key1]) && isset($_GET[$key2])) {
            return true;
        }
    }
    
}
