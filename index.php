<?php
    //this is my controller
    //output buffering
    ob_start();

    //turn on error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require_once('vendor/autoload.php');
    //this is not needed with autoload
    //require('classes/order.php');

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
        $views = new Template();
        echo $views->render('views/breakfast-menu.html');
    });

    //define a lunch route
    $f3->route('GET /lunch', function ()
    {
        $views = new Template();
        echo $views->render('views/lunch.html');
    });

    //define a route for order 1
    $f3->route('GET|POST /order1', function ($f3)
    {
        //initialize input variables.
        $food = "";
        $meal = '';


        $f3->set('meals', DataLayer::getMeal());
        //if the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $food = $_POST['food'];
            $meal = $_POST['meal'];

            //instantiate an order object and add to sesh
            $_SESSION['order'] = new Order();

            //DONE: Validate the data
            if (Validator::validFood($food)) {
                //add data to session variable
                $_SESSION['order']->setFood($food);

                //could do this to not have to session_start
                /*        $f3->set('SESSION.food', $f3->get('POST.food'));
                        $f3->set('SESSION.meal', $f3->get('POST.meal'));*/
            } else {
                $f3->set('errors["food"]', 'Please enter a food!');
            }

            if (Validator::validMeal($meal)) {
                $_SESSION['order']->setMeal($meal);
                /*$_SESSION['meal'] = $meal;*/
            } else {
                $f3->set('errors["meal"]', 'Please select a valid meal!');
            }

            //redirect user to next page if no errors
            if (empty($f3->get('errors'))) {
                $f3->reroute('order2');
            }
        }

        $f3->set('food', $food);
        $f3->set('userMeal', $meal);

        $views = new Template();
        echo $views->render('views/orderForm1.html');
    });

    //define a route for order 2
    $f3->route('GET|POST /order2', function ($f3)
    {
        //get condiments from model and add to hive
        $f3->set('conds', DataLayer::getCondiments());

        //if the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //DONE: Validate the data
            if (Validator::validCondiments($_POST['conds'])) {
                //add data to session variable
                if (isset($_POST['conds'])) {
                    $_SESSION['order']->setCondiments(implode(", ", $_POST['conds']));
                    /*$_SESSION['conds'] = implode(", ", $_POST['conds']);*/
                } else {
                    $_SESSION['order']->setCondiments("None selected.");
                }

                //redirect user to next page
                $f3->reroute('order3');
            } else {
                $f3->set('errors["condiments"]', 'Please select valid condiments!');
            }

        }

        $views = new Template();
        echo $views->render('views/orderForm2.html');
    });

    //define a form3 route
    $f3->route('GET|POST /order3', function ($f3)
    {
        $f3->set('drinks', DataLayer::getDrinks());
        //if the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //add data to session variable
            $_SESSION['order']->setDrinks($_POST['drink']);

            //redirect user to next page
            $f3->reroute('summary');

        }

        $views = new Template();
        echo $views->render('views/orderForm3.html');
    });

    //route for summary
    $f3->route('GET /summary', function ()
    {
        $views = new Template();
        echo $views->render('views/summary.html');
        //clear the session data to start again
        session_destroy();
    });

    //run fat-free -> invokes
    $f3->run();
    \

    /*
     * Conor O'Brien SDEV328
    My Diner Assignment 1/18/2022
    index.php
    */

    //send output to the browser
        ob_flush();