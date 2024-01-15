<?php
session_start();
require_once 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Add any necessary validation or hashing for the password

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $koneksi->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
		 $_SESSION["timeout"] = PHP_INT_MAX;
        header("Location: dashboard-stok.php");
        exit();
    } else {
        $error_message = "Invalid username or password";
    }
}
if (isset($_SESSION['timeout']) && time() > $_SESSION['timeout']) {
    session_destroy();
    $error_message = "Session expired. Please login again.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your existing head content here -->
    <!-- ... -->
	<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #ffffff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <?php
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>

    <form method="post" action="">
	<h2 style="text-align:center;">Login</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" name="login" value="Login">
    </form>

</body>
</html>
