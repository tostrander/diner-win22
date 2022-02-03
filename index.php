<?php
//This is my CONTROLLER

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

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
$f3->route('GET /order1', function() {
    //echo "<h1>Order 1 Form</h1>";

    $view = new Template();
    echo $view->render('views/orderForm1.html');
});

//Define a route for order 2
$f3->route('GET /order2', function() {
    //echo "<h1>Order 1 Form</h1>";

    $view = new Template();
    echo $view->render('views/orderForm2.html');
});

//Run fat-free
$f3->run();