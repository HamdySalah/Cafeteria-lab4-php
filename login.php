<?php
session_start();

$valid_username = "admin";
$valid_password = "admin123"; 
if (isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["uname"] ?? "";
    $password = $_POST["psw"] ?? "";

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION["username"] = $username;

        if (!empty($_POST["remember"])) {
            $cookie_value = bin2hex(random_bytes(16));
            setcookie("remember_token", $cookie_value, time() + (7 * 24 * 60 * 60), "/", "", true, true);
        }
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding-top: 50px;
        }
        .container {
            width: 350px;
            background: white;
            padding: 20px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px #aaa;
        }
        input, button {
            width: 90%;
            padding: 10px;
            margin: 5px 0;
        }
        button {
            background: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Login</h2>

    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

    <form action="" method="post">
        <label for="uname" style="margin-right:250px"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required>
        
        <label for="psw" style="margin-right:250px"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <button type="submit">Login</button>
        <label>
            <input type="checkbox" name="remember"> Remember me
        </label>
    </form>
</div>
</body>
</html>