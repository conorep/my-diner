<?php
    //this is my controller
    //output buffering
    ob_start();

    //turn on error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require_once('vendor/autoload.php');

    session_start();
    var_dump($_SESSION);

    //create an instance of the Base class for fat free
    $f3 = Base::instance();
    $con = new Controller($f3);

    //define a default route
    //mapping!
    $f3->route('GET /', function ()
    {
        //if only using once do this
        $GLOBALS['con']->home();
        /*global $con;
        $con->home();*/
    });

    //define a breakfast route
    $f3->route('GET /breakfast', function ()
    {
        $GLOBALS['con']->breakfast();
    });

    //define a lunch route
    $f3->route('GET /lunch', function ()
    {
        $GLOBALS['con']->lunch();
    });

    //define a route for order 1
    $f3->route('GET|POST /order1', function ()
    {
        $GLOBALS['con']->order1();
    });

    //define a route for order 2
    $f3->route('GET|POST /order2', function ()
    {
        $GLOBALS['con']->order2();
    });

    //define a form3 route
    $f3->route('GET|POST /order3', function ()
    {
        $GLOBALS['con']->order3();
    });

    //route for summary
    $f3->route('GET /summary', function ()
    {
        $GLOBALS['con']->summary();
    });

    //run fat-free -> invokes
    $f3->run();


    /*
     * Conor O'Brien SDEV328
    My Diner Assignment 1/18/2022
    index.php
    */

    //send output to the browser
    ob_flush();