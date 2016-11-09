<?php

session_start();

date_default_timezone_set('Europe/Sofia');


define('DBHOST', '127.0.0.1');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'final');


        
//Class Autoloader
spl_autoload_register(function($class){
    require_once 'classes/'. $class .'.php';
});

function generate(){
    return uniqid();
}