<?php
// simple crud class 
// require the database class to connect to the database
require_once "database.php";
class crud extends database
{
    // constructor calls the database constructor to create the connection
    public function __construct(){
        parent::__construct();
    }

    // simple create function that takes a query as a parameter and executes it
    // returns true if the query was successful, false otherwise
    public function create($query)
    {
        $result =$this->conn->query($query);
        if($result)
        {
            return true;
        }
        return false;
    }
    // read is very similar, but it returns the response if successful, or false if not
    public function read($query)
    {
        $result =$this->conn->query($query);
        if($result)
        {
            return $result;
        }
        return false;
    }
    // sanatise just uses the mysqli_real_escape_string function to prevent sql injection
    public function sanatise($query)
    {
        return $this->conn->real_escape_string($query);
    }
}