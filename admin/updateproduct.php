<?php
session_start();
require_once('../includes/config.php');
require_once('../includes/products.class.php');
require_once('../includes/users.class.php');
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
$USEROBJECT = new users();
$users      = $USEROBJECT->getUsers();
include_once('../templates/admin/header.html');
include_once('../templates/admin/menu.html');

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $title      = $_POST['title'];
    $description= $_POST['description'];
    $price      = $_POST['price'];
    $avilable   = $_POST['available'];
    $userId     = $_POST['user_id'];
    $image      = $product['image'];
    $imageName  = $_FILES['image']['name'];
    if(strlen($imageName) > 0){
        $newImage   = date('U').rand(1000,10000).$imageName;
        echo $image.'<br>'.$newImage;
        if(move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/'.$newImage))
        {
            if(file_exists('../uploads/'.$image))
                unlink('../uploads/'.$image); 
            $image  = $newImage;
        }
    }
    if($PRODOBJECT->updateProduct($prodId,$title,$description,$image,$price,$avilable,$userId))
        $success    = 'Product Updated Successfully';
    else
        $error      = 'Error';
    include_once('../templates/admin/result-message.html');
}
else
{
    if(!$product || count($product) == 0)
    {
        $error  = 'Product Not Found';
        include_once('../templates/admin/result-message.html');
    }else
        include_once('../templates/admin/update-product.html');
}
include_once('../templates/admin/footer.html');