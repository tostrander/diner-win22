<?php

// 328/my-diner/model/validation-functions.php

/**
 * Class Validator
 */
class Validator
{
    /**
     * @param $food
     * @return bool
     */
    static function validFood($food)
    {
        return strlen($food) >= 3;
    }

    /**
     * @param $meal
     * @return bool
     */
    static function validMeal($meal)
    {
        return in_array($meal, DataLayer::getMeals());
    }

    /**
     * @param $userConds
     * @return bool
     */
    static function validCondiments($userConds)
    {
        //Store the valid condiments
        $condiments = DataLayer::getCondiments();

        //Check each selected condiment
        foreach($userConds as $selection) {
            if (!in_array($selection, $condiments)) {
                return false;
            }
        }
        return true;
    }
}
