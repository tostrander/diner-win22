<?php

// 328/my-diner/model/validation-functions.php

function validFood($food)
{
    return strlen($food) >= 3;
}