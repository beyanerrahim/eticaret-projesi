<?php

include 'connect.php';
// Routes

$tpl = 'includes/templates/';
$func = 'includes/functions/';
$css = 'layout/css/';
$js = 'layout/js/';

include $func .'functions.php';
include $tpl.'header.php';

if(!isset($nonavbar)){
    include $tpl.'navbar.php';
}




?>