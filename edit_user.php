<?php
require_once 'config.php';
require_once 'classes/User.php';

$user = new User();

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid User ID.");
}

$id = intval($_GET['id']); // Sanitize ID input

// Fetch user data
$userData = $user->getUserById($id);

if (!$userData) {
    die("User not found.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $room = $_POST['room'];
    $ext = $_POST['ext'];
    
    // Handle profile picture upload
    if (!empty($_FILES['profile_picture']['name'])) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["profile_picture"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = mime_content_type($_FILES["profile_picture"]["tmp_name"]);

        // Allowed file types
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($fileType, $allowedTypes)) {
            die("Invalid file type. Allowed: JPG, PNG, GIF.");
        }

        // Validate file size (max 2MB)
        if ($_FILES["profile_picture"]["size"] > 2 * 1024 * 1024) {
            die("File is too large. Max size is 2MB.");
        }

        // Move file to upload directory
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFilePath)) {
            $profile_picture = $fileName;
        } else {
            die("Error uploading file.");
        }
    } else {
        $profile_picture = $userData['profile_picture']; // Keep existing picture
    }

    // Update user in database
    if ($user->updateUser($id, $name, $email, $room, $ext, $profile_picture)) {
        header("Location: users.php");
        exit();
    } else {
        die("Error updating user.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Edit User</h2>
    <form action="edit_user.php?id=<?= $id; ?>" method="POST" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($userData['name']); ?>" required>
        
        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($userData['email']); ?>" required>
        
        <label>Room:</label>
        <input type="text" name="room" value="<?= htmlspecialchars($userData['room']); ?>" required>
        
        <label>Extension:</label>
        <input type="text" name="ext" value="<?= htmlspecialchars($userData['ext']); ?>">
        
        <label>Profile Picture:</label>
        <input type="file" name="profile_picture">
        <br>
        <?php if ($userData['profile_picture']): ?>
            <img src="<?= htmlspecialchars($userData['profile_picture']); ?>" width="50" height="50">
        <?php else: ?>
            No Image
        <?php endif; ?>
        
        <br>
        <button type="submit">Update</button>
    </form>
    <a href="users.php">Back to Users List</a>
</body>
</html>
