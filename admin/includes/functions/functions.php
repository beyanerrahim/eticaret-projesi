<?php

/* title function */

function getTitle(){

    global $pageTitle;
    if(isset($pageTitle)){

        echo $pageTitle;
    }
    else{
        echo 'Default';
    }
}

function redirectHome($errormsg ,$url = null ,$seconds = 3){

    if($url == null){

     $url= 'index.php';
     $link ='HomePage';

    }else{

        $url = isset($_SERVER['HTTP_REFERER'] )&& $_SERVER['HTTP_REFERER'] !=='' ? $_SERVER['HTTP_REFERER'] : 'dashboard.php';
        $link ='Previous Page';
    }
     echo  $errormsg;

     echo "<div class='alert alert-info'>you will be redirected to $link after $seconds seconds </div>";

     header("refresh: $seconds ; url = $url");

     exit();
}

function checkItem($select , $from ,$value){
    global $con;

    $statment = $con->prepare("SELECT $select From $from where $select= ?"); 
    $statment->execute(array($value));
    $count = $statment->rowCount();

    return $count;

}

/*
count number of items function v1
function to count number of items rows
$item = the Item to count
$table = the table to choose from
*/
function countItems($item , $table ){

    global $con;

    $stmt2 = $con->prepare("SELECT COUNT($item) From $table");
    $stmt2->execute();
    $count = $stmt2->fetchColumn();

    return  $count;
}



/*

Get lates Records function v1.0
functon to get items from database [users , Items , Comments]
$select = field to select 
$table = the table  to choose from
$limit = number of records to get
*/

function getLatest($select ,$table ,$order,$limit = 5){
    global $con;

    $getstmt = $con->prepare("SELECT $select FROM $table ORDER BY $order desc LIMIT $limit ");
    $getstmt->execute();
    $rows = $getstmt->fetchAll();

    return  $rows;
}
