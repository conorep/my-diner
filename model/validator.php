<?php

    class Validator
    {
        static function validFood($food)
        {
            return strlen($food) >= 3;
        }

        static function validMeal($meal)
        {
            return in_array($meal, DataLayer::getMeal());
        }

        static function validCondiments($conds)
        {
            //store valid condiments
            $getCondis = DataLayer::getCondiments();

            if (!empty($conds))
            {
                foreach($conds as $cond)
                {
                    if(!in_array($cond, $getCondis))
                    {
                        return false;
                    }
                }
            }
            return true;
        }
    }
