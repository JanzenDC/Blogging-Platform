<?php
require 'backend/db_conn.php';
$test = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the email or username already exists in the database
    $email_query = "SELECT * FROM users WHERE email = '$email'";
    $username_query = "SELECT * FROM users WHERE username = '$username'";

    $email_result = $conn->query($email_query);
    $username_result = $conn->query($username_query);

    if ($email_result->num_rows > 0) {
        $test = "
            <script>
                alert('The email is already in use. Please try another one.');
                window.location.href = 'signup.php';
            </script>
        ";
    } elseif ($username_result->num_rows > 0) {
        $test = "
            <script>
                alert('The username is already taken. Please try another one.');
                window.location.href = 'signup.php';
            </script>
        ";
    } elseif ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $email = $conn->real_escape_string($email);
        $username = $conn->real_escape_string($username);
        $hashed_password = $conn->real_escape_string($hashed_password);

        $sql = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            $test = "
                <script>
                    alert('You have successfully registered.');
                    window.location.href = 'login.php';
                </script>
            ";
        } else {
            $test = "
                <script>
                    alert('An error occurred: " . $conn->error . "');
                </script>
            ";
        }
    } else {
        $test = "
            <script>
                alert('Passwords do not match. Please try again.');
                window.location.href = 'signup.php';
            </script>
        ";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kulturifiko</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* General */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('https://socialstudieshelp.com/wp-content/uploads/2024/02/Exploring-the-Cultural-Diversity-of-Europe.webp');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <div class="navbar">
        <div style="display: flex; align-items: center;">
            <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/462567709_1724925585031052_4490126238712417040_n.png?_nc_cat=109&ccb=1-7&_nc_sid=0024fc&_nc_ohc=aXcrO29n7uIQ7kNvgHCi3nC&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1QEYs_r8YD6E0edmvQDXiy__0n-15fylEZhQIi5GI1RD2Q&oe=676A986A" alt="Kulturifiko Logo">
            <h1>Kulturifiko</h1>
        </div>
        <div>
            <a href="home.php">Home</a>
            <a href="blogging-platform.php">Blogging Platform</a>
            <a href="leaderboard.php">Leaderboard</a>
            <a href="store.php">Store</a>
            <div class="dropdown">
                <a href="#" class="dropdown-btn" onclick="toggleDropdown()">Menu ▼</a>
                <div class="dropdown-content">
                    <a href="#">Profile</a>
                    <a href="#">Settings</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
            <a href="login.php" class="active">Log In</a>
        </div>
    </div>

    <style>
    /* Navigation Bar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #365486;
            padding: 20px 40px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar img {
            height: 50px;
            width: auto;
        }

        .navbar h1 {
            color: #DCF2F1;
            font-size: 2rem;
            font-weight: 600;
            margin-left: 10px;
        }

        .navbar a {
            color: #DCF2F1;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1rem;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 30px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar a:hover {
            background-color: #7FC7D9;
            color: #0F1035;
        }

        .navbar a.active {
            background-color: #000;
            color: #fff;
        }
        
    /* Dropdown */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 150px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 4px;
        }

        .dropdown-content a {
            color: black;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid #ddd;
        }

        .dropdown-content a:last-child {
            border-bottom: none;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

    /* Toggle class for show/hide */
        .show {
            display: block;
        }
    </style>

    <script>
        function toggleDropdown() {
            var dropdownContent = document.querySelector(".dropdown-content");
            dropdownContent.classList.toggle("show");
        }
    </script>
    <?php echo $test; ?>
     <!-- Main Sign-Up Section -->
     <div class="main-container">
        <div class="signup-container">
            <h2>Sign Up</h2>
            <form method="POST" action="">
                <div class="input-container">
                    <input type="text" name="email" placeholder="Email Address" required>
                </div>
                <div class="input-container">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-container">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="input-container">
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="signup-btn">Sign Up</button>
            </form>
            <div class="login-link">
                <p>Already have an account? <a href="login.php">Log In</a></p>
            </div>
        </div>

    <style>
        .main-container {
           flex-grow: 1;
           display: flex;
           justify-content: center;
           align-items: center;
       }

       .signup-container {
           background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
           padding: 40px;
           border-radius: 15px;
           width: 100%;
           max-width: 400px;
           box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
       }

       h2 {
           font-size: 2rem;
           margin-bottom: 20px;
           text-align: center;
           color: #333;
       }

       .input-container {
           margin-bottom: 15px;
           position: relative;
       }

       .input-container input {
           width: 100%;
           padding: 15px;
           border: 2px solid #ddd;
           border-radius: 10px;
           font-size: 1rem;
           outline: none;
           transition: border 0.3s ease;
           background-color: #f9f9f9;
       }

       .input-container input:focus {
           border-color: #4a6ea5;
       }

       .signup-btn {
           width: 100%;
           padding: 15px;
           background-color: #4a6ea5;
           color: white;
           border: none;
           border-radius: 10px;
           font-size: 1.1rem;
           cursor: pointer;
           transition: background-color 0.3s ease;
       }

       .signup-btn:hover {
           background-color: #1c3d8c;
       }

       .login-link {
           text-align: center;
           margin-top: 20px;
       }

       .login-link a {
           color: #4a6ea5;
           text-decoration: none;
       }

       .login-link a:hover {
           text-decoration: underline;
       }
   </style>
</body>
</html>
