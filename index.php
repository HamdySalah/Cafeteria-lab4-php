<?php
session_start();
require_once 'database.php';

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET["logout"])) {
    session_destroy();
    setcookie("remember_token", "", time() - 3600, "/");
    header("Location: login.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];
    $room = htmlspecialchars($_POST["room"]);
    $ext = htmlspecialchars($_POST["ext"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "Invalid email format.<br>";
    }

    if ($password !== $confirmPassword) {
        $error .= "Passwords do not match.<br>";
    }

    if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == 0) {
        $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
        $fileType = mime_content_type($_FILES["profile_picture"]["tmp_name"]);

        if (!in_array($fileType, $allowedTypes)) {
            $error .= "Only JPG, PNG, or GIF images are allowed.<br>";
        } else {
            if (!is_dir('uploads')) {
                mkdir('uploads', 0755, true);
            }

            $extension = pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION);
            $filename = uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
            $target_path = "uploads/" . $filename;

            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_path)) {
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
                $error .= "Error uploading file.<br>";
            }
        }
    } else {
        $error .= "Profile picture is required.<br>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Styled Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include("includes/nav.php"); ?>

    <div class="form-container">
        <div class="form-title">User Registration</div>
        <form method="POST" enctype="multipart/form-data">
            <div class="input-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="input-group">
                <label for="room">Room No</label>
                <select id="room" name="room">
                    <option value="Application1">Application1</option>
                    <option value="Application2">Application2</option>
                    <option value="Cloud">Cloud</option>
                </select>
            </div>
            <div class="input-group">
                <label for="ext">Ext</label>
                <input type="text" id="ext" name="ext">
            </div>
            <div class="input-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" required>
            </div>

            <div class="button-group">
                <button type="submit">Save</button>
                <button type="reset">Reset</button>
            </div>
        </form>
        <!-- Logout Button -->
        <button style="
            flex: 1;
            padding: 10px;
            border: none;
            margin:5px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            background-color: rgb(230, 1, 1);
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            width: 100%;
            height: 40px;
            cursor: pointer;
            transition: background 0.2s;"
            onclick="window.location.href='index.php?logout=true'">
            Logout
        </button>
    </div>
    <?php include("includes/footer.php"); ?>
</body>

</html>