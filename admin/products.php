<?php
session_start();
require_once('../includes/config.php');
require_once('../includes/products.class.php');
require_once('../includes/general.functions.php');
if(!checkLogin())
{
    header('Location:login.php');
    exit();
}

$PRODUCTS   = new product();
$allProds   = $PRODUCTS->getProducts();
include_once('../templates/admin/header.html');
include_once('../templates/admin/menu.html');
require_once('../templates/admin/all-products.html');
include_once('../templates/admin/footer.html');