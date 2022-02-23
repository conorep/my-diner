<?php
    // 328/my-diner/classes/order.php

class Order
{
    //convention is underscore for private
    private $_food;
    private $_meal;
    private $_condiments;
    private $_drinks;

    /**
     * @param $_food
     * @param $_meal
     * @param $_condiments
     * @param $_drinks
     */
    public function __construct()
    {
        $this->_food = "";
        $this->_meal = "";
        $this->_condiments = "";
        $this->_drinks = "";
    }

    /**
     * Return the food that was ordered.
     * @return string
     */
    public function getFood()
    {
        return $this->_food;
    }

    /**
     * @param string $food
     */
    public function setFood($food)
    {
        $this->_food = $food;
    }

    /**
     * Return the meal type that was ordered.
     * @return string
     */
    public function getMeal()
    {
        return $this->_meal;
    }

    /**
     * @param string $meal
     */
    public function setMeal($meal)
    {
        $this->_meal = $meal;
    }

    /**
     * Return the condiments for the food.
     * @return string
     */
    public function getCondiments()
    {
        return $this->_condiments;
    }

    /**
     * @param string $condiments
     */
    public function setCondiments($condiments)
    {
        $this->_condiments = $condiments;
    }

    /**
     * Return the drinks that were ordered.
     * @return string
     */
    public function getDrinks()
    {
        return $this->_drinks;
    }

    /**
     * @param string $drinks
     */
    public function setDrinks($drinks)
    {
        $this->_drinks = $drinks;
    }



}