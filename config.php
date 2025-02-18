<?php
session_start(); 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

define('DB_HOST', 'localhost');
define('DB_USER', 'root');      
define('DB_PASS', 'root');         
define('DB_NAME', 'cafeteria');

// ini_set('session.cookie_lifetime', 86400);
// ini_set('session.gc_maxlifetime', 86400); 

define('UPLOAD_DIR', 'uploads/');
define('ALLOWED_FILE_TYPES', ['image/jpeg', 'image/png', 'image/gif']);
define('MAX_FILE_SIZE', 2 * 1024 * 1024);

error_reporting(E_ALL); 
ini_set('display_errors', 1);

define('SITE_NAME', 'lab4'); 
define('BASE_URL', 'http://localhost/php/lab4/'); // Base URL of the project


function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function redirect($url) {
    header("Location: $url");
    exit();
}

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
?>