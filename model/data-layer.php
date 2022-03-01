<?php

//Require the database credentials
require_once $_SERVER['DOCUMENT_ROOT'].'/../pdo-config.php';

/**
 * Class DataLayer accesses data needed for the Diner app
 */
class DataLayer
{
    //Add a field to store the database connection object
    private $_dbh;

    //Define a default constructor
    //TODO: Add doc block
    function __construct()
    {
        try {
            //Instantiate a PDO database object
            $this->_dbh = new PDO (DB_DSN, DB_USERNAME, DB_PASSWORD);
            //echo "Yay!";
        }
        catch (PDOException $e) {
            echo "Error connecting to DB " . $e->getMessage();
        }
    }

    /**
     * saveOrder accepts an Order object and inserts it into the DB
     * @param $order An Order object
     * @return string The order_id of the inserted row
     */
    function saveOrder($order)
    {
        //1. Define the query
        $sql = "INSERT INTO diner_order (item, meal, condiments)
                VALUES (:food, :meal, :condiments)";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':food', $order->getFood());
        $statement->bindParam(':meal', $order->getMeal());
        $statement->bindParam(':condiments', $order->getCondiments());

        //4. Execute the query
        $statement->execute();

        //5. Process the results (get the primary key)
        $id = $this->_dbh->lastInsertId();
        return $id;

    }

    //TODO: Add docblock
    function getOrders()
    {
        //1. Define the query
        $sql = "SELECT * FROM diner_order";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the query
        $statement->execute();

        //5. Process the results (get the primary key)
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


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