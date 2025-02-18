<?php
require_once 'config.php'; // Include the configuration file

class Database {
    public $conn;

    // Constructor: Connects to the database
    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Method to get the database connection
    public function getConnection() {
        return $this->conn;
    }

    // Method to execute a query
    public function query($sql) {
        return $this->conn->query($sql);
    }

    // Method to execute a prepared statement
    public function execute($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing statement: " . $this->conn->error);
        }

        if (!empty($params)) {
            $types = str_repeat('s', count($params)); // Assume all params are strings
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt;
    }

    // Method to fetch all rows from a query
    public function fetchAll($sql, $params = []) {
        $stmt = $this->execute($sql, $params);
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Method to fetch a single row from a query
    public function fetchOne($sql, $params = []) {
        $stmt = $this->execute($sql, $params);
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Method to close the database connection
    public function close() {
        $this->conn->close();
    }

    // Destructor: Closes the database connection when the object is destroyed
    public function __destruct() {
        $this->close();
    }
}
?>