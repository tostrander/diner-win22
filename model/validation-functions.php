<?php

// 328/my-diner/model/validation-functions.php

function validFood($food)
{
    return strlen($food) >= 3;
}

function validMeal($meal)
{
    return in_array($meal, getMeals());
}

function validCondiments($userConds)
{
    //Store the valid condiments
    $condiments = getCondiments();

    //Check each selected condiment
    foreach($userConds as $selection) {
        if (!in_array($selection, $condiments)) {
            return false;
        }
    }
    return true;
}