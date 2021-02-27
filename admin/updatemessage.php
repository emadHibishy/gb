<?php
session_start();
require_once('../includes/config.php');
require_once('../includes/messages.class.php');
require_once('../includes/general.functions.php');
if(!checkLogin())
    exit('Sorry, You Are Not Allowed To Be Here.');
include_once('../templates/admin/header.html');
include_once('../templates/admin/menu.html');
$success    = '';
$error      = '';
$masgId     = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$MESSAGES   = new messages();
$message    = $MESSAGES->getMessage($masgId);
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title  = $_POST['title'];
    $content= $_POST['content'];
    $msgId  = $_POST['id'];
    if($MESSAGES->updateMessage($msgId, $title, $content))
        $success= 'Message Updated Successfully';
    else
        $error  = 'error';
        include_once('../templates/admin/result-message.html');
}else{
    if($message){
        include_once('../templates/admin/updatemessage.html'); 
    }else{
        $error  = 'Message Not Found';
        include_once('../templates/admin/result-message.html');
    }   
}
include_once('../templates/admin/footer.html');