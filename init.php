<?php

include 'admin/connect.php';
// Routes

// $tpl = 'includes/templates/';
// $css = 'layout/css/';
// $js = 'layout/js/';

$sessionemail = '';
if(isset($_SESSION['email'])){
    $sessionemail =  $_SESSION['email'];
    $name  =  $_SESSION['n'];
}

$tpl = 'includes/templates/';
$func = 'includes/functions/';
$css = 'layout/css/';
$js = 'layout/js/';

include $func .'functions.php';
include $tpl.'header.php';






?>