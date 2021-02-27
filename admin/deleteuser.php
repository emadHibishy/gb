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
$id         = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$USER       = new users();
if($USER->deleteUser($id))
    header('Location:users.php');
else
    echo 'err';


