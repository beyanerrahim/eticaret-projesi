<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo getTitle();?></title>
    <link rel="stylesheet" href="<?php echo $css;?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $css;?>font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $css;?>style2.css">
</head>
<!-- class="" -->

<body class="<?php if(isset($bodybackground)) echo $bodybackground; else echo "body-login"; ?>" >




