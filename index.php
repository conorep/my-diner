<?php
//this is my controller
//output buffering
ob_start();

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
var_dump($_SESSION);

//require the autoload file
require_once('vendor/autoload.php');

//create an instance of the Base class for fat free
$f3 = Base::instance();

//define a default route
//mapping!
$f3->route('GET /', function()
{
    session_destroy();

    $views = new Template();
    //like an include
    echo $views->render('views/home.html');
});

//define a breakfast route
$f3->route('GET /breakfast', function()
{
    $views = new Template();
    echo $views->render('views/breakfast-menu.html');
});

//define a lunch route
$f3->route('GET /lunch', function()
{

    $views = new Template();
    echo $views->render('views/lunch.html');
});

//define a route for order 1
$f3->route('GET|POST /order1', function($f3)
{
    //if the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //TODO: Validate the data

        //add data to session variable
        $_SESSION['food'] = $_POST['food'];
        $_SESSION['meal'] = $_POST['meal'];

        //redirect user to next page
        $f3->reroute('order2');
    }


    $views = new Template();
    echo $views->render('views/orderForm1.html');
});

//define a route for order 2
$f3->route('GET|POST /order2', function($f3)
{
    //if the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //TODO: Validate the data

        //add data to session variable
        $_SESSION['conds'] = $_POST['conds'];

        //redirect user to next page
        $f3->reroute('summary');
    }


    $views = new Template();
    echo $views->render('views/orderForm2.html');
});

//route for summary
$f3->route('GET /summary', function()
{
    $views = new Template();
    echo $views->render('views/summary.html');
});

//run fat-free -> invokes
$f3->run();\

/*
 * Conor O'Brien SDEV328
My Diner Assignment 1/18/2022
index.php
*/

//send output to the browser
ob_flush();