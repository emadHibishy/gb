<?php
session_start();
require_once('../includes/config.php');
require_once('../includes/messages.class.php');
require_once('../includes/general.functions.php');
if(!checkLogin())
    exit('Sorry, You Are Not Allowed To Be Here.');
$MSG    = new messages();
$msgs   = $MSG->getMessages('ORDER BY `id` DESC');
include('../templates/admin/header.html');
include('../templates/admin/menu.html');
include('../templates/admin/all-messages.html');
include('../templates/admin/footer.html');