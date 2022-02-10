<?php

function validFood($food)
{
    return strlen($food) >= 3;
}

function validMeal($meal)
{
    return in_array($meal, getMeal());
}

function validCondiments($conds)
{
    //store valid condiments
    $getCondis = getCondiments();

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