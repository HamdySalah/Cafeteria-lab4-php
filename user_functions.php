<?php
require_once 'config.php';
require_once 'database.php';


function getUsers($conn) {
    $stmt = $conn->query("SELECT * FROM users ORDER BY id ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to add a new user
function addUser($conn, $name, $email, $password, $room, $ext, $profile_picture) {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, room, ext, profile_picture) VALUES (?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$name, $email, $hashedPassword, $room, $ext, $profile_picture]);
}

// Function to update an existing user
function updateUser($conn, $id, $name, $email, $room, $ext, $profile_picture) {
    $stmt = $conn->prepare("UPDATE users SET name=?, email=?, room=?, ext=?, profile_picture=? WHERE id=?");
    return $stmt->execute([$name, $email, $room, $ext, $profile_picture, $id]);
}

// Function to delete a user
function deleteUser($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    return $stmt->execute([$id]);
}
