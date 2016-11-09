<?php

class Input{
    
    public static function getInputData($data){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            return $_POST[$data];
        }
        elseif($_SERVER['REQUEST_METHOD'] === 'GET'){
            return $_GET[$data];
        }
    }
}