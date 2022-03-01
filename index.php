<?php

//Turn on output buffering
ob_start();

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Start the session
session_start();
var_dump($_SESSION);

//Create an instance of the Base class
$f3 = Base::instance();
$con = new Controller($f3);
$dataLayer = new DataLayer();

//Define a default route
$f3->route('GET /', function() {
    $GLOBALS['con']->home();

    //global $con;
    //$con->home();
});

//Define a breakfast route
$f3->route('GET /breakfast', function() {
    //echo "<h1>My Diner</h1>";

    $view = new Template();
    echo $view->render('views/breakfast-menu.html');
});

//Define a lunch route
$f3->route('GET /lunch', function() {

    $view = new Template();
    echo $view->render('views/lunch-menu.html');
});

//Define a route for order 1
$f3->route('GET|POST /order1', function($f3) {

    $GLOBALS['con']->order1();
});

//Define a route for order 2
$f3->route('GET|POST /order2', function($f3) {

    $GLOBALS['con']->order2();
});

//Define a summary route
$f3->route('GET /summary', function() {

    $GLOBALS['con']->summary();
});

//Run fat-free
$f3->run();

//Send output to the browser
ob_flush();