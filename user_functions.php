<?php
require_once 'config.php';
require_once 'classes/Database.php';

function getUsers($conn) {
    $sql = "SELECT * FROM users ORDER BY id ASC";
    return $conn->fetchAll($sql);
}

function addUser($conn, $name, $email, $password, $room, $ext, $profile_picture) {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (name, email, password, room, ext, profile_picture) VALUES (?, ?, ?, ?, ?, ?)";
    return $conn->execute($sql, [$name, $email, $hashedPassword, $room, $ext, $profile_picture]);
}

function updateUser($conn, $id, $name, $email, $room, $ext, $profile_picture) {
    $sql = "UPDATE users SET name=?, email=?, room=?, ext=?, profile_picture=? WHERE id=?";
    return $conn->execute($sql, [$name, $email, $room, $ext, $profile_picture, $id]);
}

function deleteUser($conn, $id) {
    $sql = "DELETE FROM users WHERE id=?";
    return $conn->execute($sql, [$id]);
}
?>
