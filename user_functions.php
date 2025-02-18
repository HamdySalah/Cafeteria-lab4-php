<?php
// require 'database.php';
// require 'validate.php';

// function addUser($name, $email, $password) {
//     if (!validateEmail($email) || !validatePassword($password)) {
//         return "Invalid email or password!";
//     }
    
//     $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
//     return insertRecord('users', ['name', 'email', 'password'], [$name, $email, $hashedPassword]);
// }

// function updateUser($id, $name, $email) {
//     return executeQuery("UPDATE users SET name = ?, email = ? WHERE id = ?", [$name, $email, $id]);
// }

// function deleteUser($id) {
//     return executeQuery("DELETE FROM users WHERE id = ?", [$id]);
// }

// function getAllRooms() {
//     return executeQuery("SELECT * FROM rooms")->fetchAll();
// }
?>
