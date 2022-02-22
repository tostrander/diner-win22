<?php

//  328/my-diner/controller/controller.php

class Controller
{
    private $_f3; //F3 object

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        //echo "<h1>My Diner</h1>";

        $view = new Template();
        echo $view->render('views/home.html');
    }

    function order1()
    {
        //Initialize input variables
        $food = "";
        $meal = "";

        //If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // = $f3->get('POST.food');
            $food = $_POST['food'];
            $meal = $_POST['meal'];

            //Instantiate an order object
            //$order = new Order();
            //$_SESSION['order'] = $order;

            $_SESSION['order'] = new Order();

            //Validate the data
            if(Validator::validFood($food)) {

                //Add the data to the session variable
                $_SESSION['order']->setFood($food);
            }
            else {

                //Set an error
                $this->_f3->set('errors["food"]', 'Please enter a food');
            }

            if(Validator::validMeal($meal)) {

                //Add the data to the session variable
                $_SESSION['order']->setMeal($meal);
            }
            else {

                //Set an error
                $this->_f3->set('errors["meal"]', 'Please select a valid meal');
            }

            //Redirect user to next page if there are no errors
            if (empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('order2');
            }
        }

        $this->_f3->set('food', $food);
        $this->_f3->set('userMeal', $meal);
        $this->_f3->set('meals', DataLayer::getMeals());

        $view = new Template();
        echo $view->render('views/orderForm1.html');
    }

    function order2()
    {
        //Get the condiments from the model and add to F3 hive
        $this->_f3->set('conds', DataLayer::getCondiments());

        //If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Add the data to the session variable
            //If condiments were selected
            if (isset($_POST['conds'])) {

                $conds = $_POST['conds'];

                //If condiments are valid
                if (Validator::validCondiments($conds)) {
                    $conds = implode(", ", $_POST['conds']);
                }
                else {
                    $this->_f3->set("errors['cond']", "Invalid selection");
                }
            }
            else {

                $conds = "None selected";
            }

            //Redirect user to summary page
            if (empty($this->_f3->get('errors'))) {
                $_SESSION['order']->setCondiments($conds);
                $this->_f3->reroute('summary');
            }
        }

        $view = new Template();
        echo $view->render('views/orderForm2.html');
    }

    function summary()
    {
        //echo "<h1>My Diner</h1>";

        //TODO: Send data to the model

        $view = new Template();
        echo $view->render('views/summary.html');

        //Clear the session data
        session_destroy();
    }
}