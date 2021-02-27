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
$allUsers   = $USER->getUsers();
include_once('../templates/admin/header.html');
include_once('../templates/admin/menu.html');
require_once('../templates/admin/all-users.html');
include_once('../templates/admin/footer.html');