<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Navigation Bar</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        /* Custom Navbar Styling */
        .navbar {
            background-color: #007BFF; /* Blue background */
            padding: 10px 0; /* Add some padding */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .navbar ul {
            list-style: none; /* Remove default list styling */
            padding: 0;
            margin: 0;
            display: flex; /* Make the list horizontal */
            align-items: center; /* Center items vertically */
        }

        .navbar ul li {
            margin: 0 10px; /* Space between items */
        }

        .navbar ul li a {
            color: white !important; /* White text */
            text-decoration: none; /* Remove underline */
            font-size: 16px; /* Font size */
            padding: 8px 12px; /* Padding for clickable area */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s ease; /* Smooth hover effect */
        }

        .navbar ul li a:hover {
            background-color: rgba(255, 255, 255, 0.1); /* Light hover effect */
        }

        .navbar ul li a span {
            margin-left: 5px; /* Space between icon and text */
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar ul {
                flex-direction: column; /* Stack items vertically on small screens */
                align-items: flex-start;
            }

            .navbar ul li {
                margin: 5px 0; /* Adjust spacing for vertical layout */
            }

            .navbar ul li:not(:last-child)::after {
                display: none; /* Hide separators on small screens */
            }
        }
    </style>
</head>
<body>
    <header>
        <nav id="menu" class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="index.htm">Cafetria </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.htm"><span>Home</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><span>Products</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="welcome.php"><span>Users</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><span>Manual Order</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><span>Checks</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>