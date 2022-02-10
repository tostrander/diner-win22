<?php
//This is my CONTROLLER

//Turn on output buffering
ob_start();

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start the session
//session_start();
//var_dump($_SESSION);

//Require the autoload file
require_once('vendor/autoload.php');
require('model/data-layer.php');
require('model/validation-functions.php');

//Create an instance of the Base class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function() {
    //echo "<h1>My Diner</h1>";

    $view = new Template();
    echo $view->render('views/home.html');
});

//Define a breakfast route
$f3->route('GET /breakfast', function() {
    //echo "<h1>My Diner</h1>";

    $view = new Template();
    echo $view->render('views/breakfast-menu.html');
});

//Define a lunch route
$f3->route('GET /lunch', function() {
    //echo "<h1>My Diner</h1>";

    $view = new Template();
    echo $view->render('views/lunch-menu.html');
});

//Define a route for order 1
$f3->route('GET|POST /order1', function($f3) {
    //echo "<h1>Order 1 Form</h1>";

    //If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // = $f3->get('POST.food');
        $food = $_POST['food'];

        //TODO: Validate the data
        if(validFood($food)) {
            //Add the data to the session variable
            //$_SESSION['food'] = $_POST['food'];
            //$_SESSION['meal'] = $_POST['meal'];

            $f3->set('SESSION.food', $food);
            $f3->set('SESSION.meal', $f3->get('POST.meal'));

            //Redirect user to next page
            $f3->reroute('order2');
        }
        else {
            $f3->set('errors["food"]', 'Please enter a food');
        }
    }

    $view = new Template();
    echo $view->render('views/orderForm1.html');
});

//Define a route for order 2
$f3->route('GET|POST /order2', function($f3) {
    //echo "<h1>Order 1 Form</h1>";

    //Get the condiments from the model and add to F3 hive
    $f3->set('conds', getCondiments());

    //If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //TODO: Validate the data

        //Add the data to the session variable
        //If condiments were selected
        if (isset($_POST['conds'])) {
            //$_SESSION['conds'] = implode(", ", $_POST['conds']);
            $conds = implode(", ", $f3->get('POST.conds'));

        }
        else {
            //$_SESSION['conds'] = "None selected";
            $conds = "None selected";
        }
        $f3->set('SESSION.conds', $conds);

        //Redirect user to summary page
        $f3->reroute('summary');
    }

    $view = new Template();
    echo $view->render('views/orderForm2.html');
});

//Define a summary route
$f3->route('GET /summary', function() {
    //echo "<h1>My Diner</h1>";

    //TODO: Send data to the model

    $view = new Template();
    echo $view->render('views/summary.html');

    //Clear the session data
    session_destroy();
});

//Run fat-free
$f3->run();

//Send output to the browser
ob_flush();