<?php
session_start();
require_once('includes/config.php');
require_once('includes/products.class.php');
$active = 'products';
include('templates/front/header.html');
$prodId     = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$PRODUCT    = new product();
$prod       = $PRODUCT->getProduct($prodId);
if(!$prod)
    include('templates/front/404.html');
else
    include('templates/front/product-info.html');
include('templates/front/footer.html');