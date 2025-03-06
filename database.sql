CREATE DATABASE lab5_db;

USE lab5_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    room VARCHAR(255) NOT NULL,
    ext VARCHAR(255),
    profile_picture VARCHAR(255),
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert an admin user for testing
INSERT INTO users (name, email, password, room, ext, profile_picture, role) VALUES 
('Admin', 'admin@example.com', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHeFupQe1rY1P1u1e1u1e1u1e1u1e1u1e', 'Admin Room', '1234', 'uploads/default.png', 'admin');
