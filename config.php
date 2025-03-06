<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'lab5_db'); // Updated database name

define('UPLOAD_DIR', 'uploads/');
define('ALLOWED_FILE_TYPES', ['image/jpeg', 'image/png', 'image/gif']);
define('MAX_FILE_SIZE', 2 * 1024 * 1024);

error_reporting(E_ALL); 
ini_set('display_errors', 1);

define('SITE_NAME', 'lab5');
define('BASE_URL', 'http://localhost/php/lab4/'); // Base URL of the project

require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/User.php';

function getDBConnection() {
    try {
        $conn = new PDO("mysql:host=" . DB_HOST . ";port=3307;dbname=" . DB_NAME, DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

function redirect($url) {
    header("Location: $url");
    exit();
}

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
?>