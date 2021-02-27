<?php
session_start();
require_once('../includes/config.php');
require_once('../includes/messages.class.php');
require_once('../includes/general.functions.php');
if(!checkLogin())
    exit('Sorry, You Are Not Allowed To Be Here.');
include_once('../templates/admin/header.html');
include_once('../templates/admin/menu.html');
$success= '';
$error  = '';
$masgId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$MESSAGE= new messages();
if($MESSAGE->getMessage($masgId)){
    if($MESSAGE->deleteMessage($masgId))
        $success= 'Message Deleted Successfully';
    else
        $error  = 'error';
}else{
    $error  = 'error';
}
include_once('../templates/admin/result-message.html');
include_once('../templates/admin/footer.html');