<?php
// this is a very simple database connection class
class database
{
    // database connection variables
    private $host = "localhost";
    private $username = "root";
    private $password = "mysql";
    private $database = "assignment2";

    // create a connection variable to store the connection
    protected $conn;
    // constructor to create the connection
    public function __construct()
    {
        // attempt to connect to the database using mysqli_connect
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        // if the connection fails, show the error and KILL the process
        if (mysqli_connect_error()) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

}