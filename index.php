<?php

require_once 'config/config.php';
require_once 'views/layout.php';
$app = new App();
$app->loadPage();

//Login
if (isset($_POST['login'])) {
    $user = new User();
    $user->login();
}
//Register
if (isset($_POST['register'])) {
    $user = new User();
    $user->register();
}

if(isset($_SESSION['loggedIn'])){
    $content = new Dir();

    //Create folder
    if(isset($_POST['create_folder'])){
        $content->dirCreate();
    }

    //Rename folder
    if(isset($_POST['rename'])){
        $content->rename($_POST['newName']);
    }

    //Delete folder
    if(isset($_POST['delete'])){
        $content->delete();
    }
}





    

    
    
?>