<?php
session_start();
require_once('../includes/config.php');
require_once('../includes/products.class.php');
require_once('../includes/users.class.php');
require_once('../includes/general.functions.php');
if(!checkLogin())
{
    header('Location:login.php');
    exit();
}
$error      = '';
$success    = '';
$PRODUCT    = new product();
$USER       = new users();
$users      = $USER->getUsers();

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $title          = $_POST['title'];
    $description    = $_POST['description'];
    $price          = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT) ;
    $available      = $_POST['available'];
    $userId         = $_POST['user_id'];
    $image          = $_FILES['image']['name']; 
    if(strlen($image) > 0)
    {
        $imageName      = date('U').rand(1000,100000).$image;
        move_uploaded_file($_FILES['image']['tmp_name'],'../uploads/'.$imageName);
        if($PRODUCT->addProduct($title, $description, $imageName, $price, $available,$userId))
            $success= 'added successfully';
        else
            $error  = 'err';
    }else
        $error  = 'please, attach an image';
    
}
include_once('../templates/admin/header.html');
include_once('../templates/admin/menu.html');
require_once('../templates/admin/add-product.html');
include_once('../templates/admin/footer.html');