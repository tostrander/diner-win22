<?php

/**
 * Class DataLayer accesses data needed for the Diner app
 */
class DataLayer
{
    /**
     * Return an array of condiments
     * @return string[]
     */
    static function getCondiments()
    {
        return array('mayonnaise', 'mustard', 'ketchup', 'salsa', 'kim chi', 'sriracha');
    }

    /**
     * Return an array of meal options
     * @return string[]
     */
    static function getMeals()
    {
        return array('breakfast', 'lunch', 'dinner');
    }
}