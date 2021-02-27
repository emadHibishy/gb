<?php
session_start();
require_once('includes/config.php');
require_once('includes/products.class.php');
$active = 'products';
include('templates/front/header.html');
$PRODUCT    = new product();
$products   = $PRODUCT->getProducts('ORDER BY `id` DESC');
include('templates/front/products.html');
include('templates/front/footer.html');