<?php
if (!class_exists('Database')) {
    class Database {
        private $conn;

        public function __construct() {
            try {
                $this->conn = new PDO("mysql:host=" . DB_HOST . ";port=3307;dbname=" . DB_NAME, DB_USER, DB_PASS);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        public function query($sql) {
            return $this->conn->query($sql);
        }

        public function execute($sql, $params = []) {
            $stmt = $this->conn->prepare($sql);
            if ($stmt === false) {
                die("Error preparing statement: " . $this->conn->errorInfo()[2]);
            }
            $stmt->execute($params);
            return $stmt;
        }

        public function fetchAll($sql, $params = []) {
            $stmt = $this->execute($sql, $params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function fetchOne($sql, $params = []) {
            $stmt = $this->execute($sql, $params);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function close() {
            $this->conn = null;
        }

        public function __destruct() {
            $this->close();
        }
    }
}
?>
