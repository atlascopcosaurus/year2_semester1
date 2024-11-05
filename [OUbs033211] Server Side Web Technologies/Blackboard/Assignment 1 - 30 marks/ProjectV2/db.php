<?php
class CreateDb
{
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $con;

    // Class constructor
    public function __construct(
        $dbname = "shop",
        $tablename = "users",
        $servername = "localhost",
        $username = "shopadmin",
        $password = "4PCtBGtTqUjoYTIFkp5s"
    ) {
        $this->dbname = $dbname;
        $this->tablename = $tablename;
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;

        // Create connection
        $this->con = new mysqli($servername, $username, $password);

        // Check connection
        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error);
        }

        // Create database if it doesn't exist
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        if ($this->con->query($sql) === TRUE) {
            // Connect to the newly created or existing database
            $this->con = new mysqli($servername, $username, $password, $dbname);

            // Create table if it doesn't exist
            $sql = "CREATE TABLE IF NOT EXISTS $tablename (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                first_name VARCHAR(50) NOT NULL,
                last_name VARCHAR(50) NOT NULL,
                username VARCHAR(50) NOT NULL UNIQUE,
                email VARCHAR(100) NOT NULL UNIQUE,
                phone VARCHAR(15),
                password VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";

            if ($this->con->query($sql) !== TRUE) {
                echo "Error creating table: " . $this->con->error;
            }
        } else {
            echo "Error creating database: " . $this->con->error;
        }
    }

    // Method to close the connection
    public function closeConnection()
    {
        $this->con->close();
    }
}

