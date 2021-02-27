<?php
session_start();

require_once('../includes/config.php');
require_once('../includes/products.class.php');
require_once('../includes/general.functions.php');
if(!checkLogin())
{
    header('LOCATION:login.php');
    exit();
}
$error  = '';
$success= '';
$prodId     = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$PRODOBJECT = new product();
$product    = $PRODOBJECT->getProduct($prodId);
if($PRODOBJECT->deleteProduct($prodId))
{
    if(file_exists('../uploads/'.$product['image']))
    {
        unlink('../uploads/'.$product['image']);
        $success    = 'product deleted successfully';
    }
}else
    $error  = 'error';

include_once('../templates/admin/header.html');
include_once('../templates/admin/menu.html');
include_once('../templates/admin/result-message.html');
include_once('../templates/admin/footer.html');