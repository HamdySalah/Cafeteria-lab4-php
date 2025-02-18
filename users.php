<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
// require 'user_functions.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (isset($_POST['add_user'])) {
//         $name = trimInput($_POST['name']);
//         $email = trimInput($_POST['email']);
//         $password = $_POST['password'];
//         addUser($name, $email, $password);
//     }
// }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
</head>
<body>
    <h2>Add User</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="add_user">Add User</button>
    </form>
</body>
</html>
