<?php

//$options = [
//    'host' => 'localhost',
//    'user' => 'root',
//    'pass' => '',
//    'name' => 'final'
//];

spl_autoload_register(function($class){
    require_once 'classes/'. $class . '.php';
});
