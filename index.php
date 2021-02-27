<?php
session_start();
require_once('includes/config.php');
require_once('includes/products.class.php');
$PRODUCT    = new product();
$newProds   = $PRODUCT->getProducts('ORDER BY `id` DESC LIMIT 3');

$active = 'home';
include('templates/front/header.html');
include('templates/front/index.html');
include('templates/front/footer.html');