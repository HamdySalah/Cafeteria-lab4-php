<?php
require_once 'config.php';
require_once 'database.php';

session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];
    $room = htmlspecialchars($_POST["room"]);
    $ext = htmlspecialchars($_POST["ext"]);

    if (empty($name)) {
        $error .= "Name is required.<br>";
    }

    if (empty($email)) {
        $error .= "Email is required.<br>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "Invalid email format.<br>";
    }

    if (empty($password)) {
        $error .= "Password is required.<br>";
    } elseif (strlen($password) < 8) {
        $error .= "Password must be at least 8 characters long.<br>";
    }

    if ($password !== $confirmPassword) {
        $error .= "Passwords do not match.<br>";
    }

    if (empty($room)) {
        $error .= "Room number is required.<br>";
    }

    if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == 0) {
        $fileType = mime_content_type($_FILES["profile_picture"]["tmp_name"]);

        if (!in_array($fileType, ALLOWED_FILE_TYPES)) {
            $error .= "Only JPG, PNG, or GIF images are allowed.<br>";
        } elseif ($_FILES["profile_picture"]["size"] > MAX_FILE_SIZE) {
            $error .= "File size must be less than 2MB.<br>";
        } else {
            if (!is_dir(UPLOAD_DIR)) {
                mkdir(UPLOAD_DIR, 0755, true);
            }

            $extension = pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION);
            $filename = uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
            $target_path = UPLOAD_DIR . $filename;
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_path)) {

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $db = new Database();
                $sql = "INSERT INTO users (name, email, password, room, ext, profile_picture) VALUES (?, ?, ?, ?, ?, ?)";
                $params = [$name, $email, $hashedPassword, $room, $ext, $target_path];
                $stmt = $db->execute($sql, $params);

                if ($stmt->affected_rows > 0) {
                    $_SESSION['form_data'] = [
                        'name' => $name,
                        'email' => $email,
                        'room' => $room,
                        'ext' => $ext,
                        'profile_picture' => $target_path
                    ];
                    header('Location: welcome.php');
                    exit();
                } else {
                    $error .= "Error saving user data.<br>";
                }
            } else {
                $error .= "Error uploading file.<br>";
            }
        }
    } else {
        $error .= "Profile picture is required.<br>";
    }
    if (!empty($error)) {
        $_SESSION['error'] = $error;
        header('Location: index.php');
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
?>