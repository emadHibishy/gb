<?php
session_start();
require_once('../includes/config.php');
require_once('../includes/general.functions.php');
require_once('../includes/users.class.php');

if(checkLogin()){
    header('Location:index.php');
    exit();
}
$error ='';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $user       = new users();
    $userData   = $user->login($username, $password);
    if($userData && count($userData) > 0){
        $_SESSION['user']   = $userData;
        header('Location:index.php');
    }else{
        $error = 'username or password is not correct';
    }
}

include_once('../templates/admin/login.html');
?>
