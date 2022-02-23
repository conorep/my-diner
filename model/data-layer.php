<?php


    class DataLayer
    {
        /**
         * return an array of condiments
         * @return string[]
         */
        static function getCondiments()
        {
            return array('ketchup', 'mustard', 'sriracha', 'mayo', 'salsa');
        }

        /**
         * return an array of meal options
         * @return string[]
         */
        static function getMeal()
        {
            return array('breakfast', 'lunch', 'dinner');
        }

        /**
         * return an array of drinks
         * @return string[]
         */
        static function getDrinks()
        {
            return array('sprite', 'coke', 'mtn dew');
        }
    }
