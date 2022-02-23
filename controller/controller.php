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
    }