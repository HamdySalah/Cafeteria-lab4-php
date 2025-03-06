<?php
require_once 'config.php';
session_start();
require_once 'classes/User.php';

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['form_data'])) {
    header("Location: index.php");
    exit();
}

$data = $_SESSION['form_data'];
unset($_SESSION['form_data']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        nav {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        nav h1 {
            margin: 0;
            font-size: 24px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img.profile {
            max-width: 100px;
            height: auto;
            border-radius: 50%;
        }

        .container {
            text-align: center;
            margin: 20px 0;
        }

        .container a {
            color: #007BFF;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .container a:hover {
            color: #0056b3;
        }

        footer {
            background-color: #343a40; 
            color: white; 
            padding: 20px 0;
            text-align: center; 
            font-family: Arial, sans-serif; 
            margin-top: auto; 
        }

        footer a {
            color: #007BFF; 
            text-decoration: none; 
            margin: 0 10px;
            font-weight: bold; 
            transition: color 0.3s ease; 
        }

        footer a:hover {
            color: #0056b3; 
        }

        footer p {
            margin: 10px 0 0; 
            font-size: 14px; 
            color: rgba(255, 255, 255, 0.8);
        }

        @media (max-width: 768px) {
            table {
                width: 95%; 
            }

            footer {
                padding: 15px 0; 
            }

            footer a {
                display: block; 
                margin: 10px 0; 
            }
        }
    </style>
</head>
<body>
    <?php include("includes/nav.php"); ?>

    <h2 style="text-align: center;">User Registration Details</h2>
    <h4 align="center"><?php echo "Welcome Back ". $_SESSION['username'];?></h4>
    <table>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>Name</td>
            <td><?php echo htmlspecialchars($data['name']); ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo htmlspecialchars($data['email']); ?></td>
        </tr>
        <tr>
            <td>Room No</td>
            <td><?php echo htmlspecialchars($data['room']); ?></td>
        </tr>
        <tr>
            <td>Ext</td>
            <td><?php echo htmlspecialchars($data['ext']); ?></td>
        </tr>
        <tr>
            <td>Profile Picture</td>
            <td>
                <?php if (file_exists($data['profile_picture'])): ?>
                    <img src="<?php echo $data['profile_picture']; ?>" 
                         alt="Profile Picture" class="profile">
                <?php else: ?>
                    <p style="color: red;">Image not found</p>
                <?php endif; ?>
            </td>
        </tr>
    </table>

    <div class="container">
        <a href="index.php">Add New User</a> | 
        <a href="index.php?logout=true">Logout</a>
    </div>

    <!-- Include Footer -->
    <?php include("includes/footer.php"); ?>
</body>
</html>