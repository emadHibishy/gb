<?php
session_start();
require_once('../includes/config.php');
require_once('../includes/users.class.php');
require_once('../includes/general.functions.php');
if(!checkLogin())
{
    header('Location:login.php');
    exit();
}
$USER   = new users();
$error  = '';
$success= '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    if(!empty($username) && !empty($email) && !empty($password)){
        if($USER->addUser($username,$email,$password))
            $success= 'user added successfully';
        else
            $error  = 'something went wrong';   
    }else{
        $error  = 'please fill all fields';
    }
    // header('LOCATION:adduser.php');
}

include_once('../templates/admin/header.html');
include_once('../templates/admin/menu.html');
require_once('../templates/admin/add-user.html');
include_once('../templates/admin/footer.html');