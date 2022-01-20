<?php

//this is my controller

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require the autoload file
require_once('vendor/autoload.php');

//create an instance of the Base class for fat free
$f3 = Base::instance();

//define a default route
//mapping!
$f3->route('GET /', function()
{
    /*echo "<h1>My Diner</h1>";*/

    $views = new Template();
    echo $views->render('views/home.html');
});

//run fat-free -> invokes
$f3->run();

?>
<!--
Conor O'Brien SDEV328
My Diner Assignment 1/18/2022
index.php
-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Diner</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">

    <!--  Favicon  -->
    <link rel="icon" type="image/png" href="images/fallWork.jpg">
</head>
<body>

</body>
</html>
