<?php
session_start();
if(!isset($_SESSION['user']['username']))
{
    header('Location:login.php');
}
include_once('../templates/admin/header.html');
include_once('../templates/admin/menu.html');
include_once('../templates/admin/index.html');
include_once('../templates/admin/footer.html');