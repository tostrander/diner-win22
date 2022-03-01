<?php

//  328/my-diner/classes/order.php

/**
 * Order class represents a customer's diner order
 */
class Order
{
    private $_food;
    private $_meal;
    private $_condiments;

    /**
     * Order constructor.
     * $order = new Order();
     * $order = new Order("taco", "lunch", "salsa");
     * @param $_food
     * @param $_meal
     * @param $_condiments
     */
    public function __construct($food = "", $meal = "", $condiments = "")
    {
        $this->_food = $food;
        $this->_meal = $meal;
        $this->_condiments = $condiments;
    }

    /**
     * Return the food that was ordered
     * @return string
     */
    public function getFood(): string
    {
        return $this->_food;
    }

    /**
     * Set the food that was ordered
     * @param string $food
     */
    public function setFood(string $food): void
    {
        $this->_food = $food;
    }

    /**
     * @return string
     */
    public function getMeal(): string
    {
        return $this->_meal;
    }

    /**
     * @param string $meal
     */
    public function setMeal(string $meal): void
    {
        $this->_meal = $meal;
    }

    /**
     * @return string
     */
    public function getCondiments(): string
    {
        return $this->_condiments;
    }

    /**
     * @param string $condiments
     */
    public function setCondiments(string $condiments): void
    {
        $this->_condiments = $condiments;
    }
}