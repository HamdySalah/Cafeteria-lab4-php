<?php
require_once 'Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM users WHERE role != 'admin' ORDER BY id ASC";
        return $this->db->fetchAll($sql);
    }

    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        return $this->db->fetchOne($sql, [$id]);
    }

    public function addUser($name, $email, $password, $room, $ext, $profile_picture) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, password, room, ext, profile_picture) VALUES (?, ?, ?, ?, ?, ?)";
        return $this->db->execute($sql, [$name, $email, $hashedPassword, $room, $ext, $profile_picture]);
    }

    public function updateUser($id, $name, $email, $room, $ext, $profile_picture) {
        $sql = "UPDATE users SET name = ?, email = ?, room = ?, ext = ?, profile_picture = ? WHERE id = ?";
        return $this->db->execute($sql, [$name, $email, $room, $ext, $profile_picture, $id]);
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        return $this->db->execute($sql, [$id]);
    }
}
?>
