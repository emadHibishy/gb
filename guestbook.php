<?php
include("includes/config.php");
include("includes/messages.class.php");
$active = 'messages';
include('templates/front/header.html');
$success    = '';
$error      = '';
$MESSAGE    = new messages();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title  = $_POST['title'];
    $content= $_POST['content'];
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    if($MESSAGE->addMessage($title, $content, $name, $email))
        $success    = 'Message Added Successfully';
    else
        $error      = 'Error';
    // include('templates/front/result-message.html');
}else{
    $messages   = $MESSAGE->getMessages('ORDER BY `id` DESC');
}
include("templates/front/guestbook.html");
include('templates/front/footer.html');