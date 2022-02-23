<?php

//328/my-diner/controller/controller.php
    class Controller
    {
        private $_f3; //f3 object

        function __construct($f3)
        {
            $this->_f3 = $f3;
        }

        function home()
        {
            session_destroy();

            $views = new Template();
            //like an include
            echo $views->render('views/home.html');
        }

        function order1()
        {
            //initialize input variables.
            $food = "";
            $meal = '';


            $this->_f3->set('meals', DataLayer::getMeal());
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
                    $this->_f3->set('errors["food"]', 'Please enter a food!');
                }

                if (Validator::validMeal($meal)) {
                    $_SESSION['order']->setMeal($meal);
                    /*$_SESSION['meal'] = $meal;*/
                } else {
                    $this->_f3->set('errors["meal"]', 'Please select a valid meal!');
                }

                //redirect user to next page if no errors
                if (empty($this->_f3->get('errors'))) {
                    $this->_f3->reroute('order2');
                }
            }

            $this->_f3->set('food', $food);
            $this->_f3->set('userMeal', $meal);

            $views = new Template();
            echo $views->render('views/orderForm1.html');
        }

        function order2()
        {
            //get condiments from model and add to hive
            $this->_f3->set('conds', DataLayer::getCondiments());

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
                    $this->_f3->reroute('order3');
                } else {
                    $this->_f3->set('errors["condiments"]', 'Please select valid condiments!');
                }

            }

            $views = new Template();
            echo $views->render('views/orderForm2.html');
        }

        function order3()
        {
            $this->_f3->set('drinks', DataLayer::getDrinks());
            //if the form has been posted
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //add data to session variable
                $_SESSION['order']->setDrinks($_POST['drink']);

                //redirect user to next page
                $this->_f3->reroute('summary');

            }

            $views = new Template();
            echo $views->render('views/orderForm3.html');
        }

        function summary()
        {
            $views = new Template();
            echo $views->render('views/summary.html');
            //clear the session data to start again
            session_destroy();
        }

        function breakfast()
        {
            $views = new Template();
            echo $views->render('views/breakfast-menu.html');
        }

        function lunch()
        {
            $views = new Template();
            echo $views->render('views/lunch.html');
        }
    }