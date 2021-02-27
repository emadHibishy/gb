<?php
session_start();
require_once('../includes/config.php');
require_once('../includes/users.class.php');
require_once('../includes/general.functions.php');
if(checkLogin())
{
    header('LOCATION:login.php');
    exit();
}
$userId     = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$USER       = new users();
$userData   = $USER->getUser($userId);
$error      = '';
$success    = '';
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    if(strlen($username) > 0 && strlen($email) > 0)
    {
        if($USER->updateUser(6, $username, $email, $password))
            $success    = 'updated successfully';
        else
            $error      = 'error';
    }else
        $error = 'fill all fields';
}
include_once('../templates/admin/header.html');
include_once('../templates/admin/menu.html');
include_once('../templates/admin/update-user.html');
include_once('../templates/admin/footer.html');