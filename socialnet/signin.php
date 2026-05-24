<?php
session_start();
require_once '../db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SocialNet - Login</title>
    <style>
        html, body { margin: 0; padding: 0; background-color: #ffffff; font-family: Arial, sans-serif; }
        body { display: flex; justify-content: center; align-items: center; height: 100vh; }
        .container { text-align: center; background: #f9f9f9; padding: 30px; border: 1px solid #ddd; border-radius: 8px; width: 100%; max-width: 360px; }
        h2 { color: #333; margin-bottom: 20px; }
        input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #444; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; }
        button:hover { background-color: #222; }
        .signup-link { margin-top: 15px; font-size: 14px; }
        .signup-link a { color: #a00; text-decoration: none; font-weight: bold; }
        .signup-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to SocialNet</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $_POST['username'];
            $pass = $_POST['password'];

            $sql = "SELECT * FROM account WHERE username = '$user'";
            $result = db_query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();

                if (password_verify($pass, $row['password'])) {
                    $_SESSION['user_id']  = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['role']     = $row['role'];

                    header("Location: index.php");
                    exit();
                } else {
                    echo "<p style='color:red; margin-bottom:15px;'>Invalid Password!</p>";
                }
            } else {
                echo "<p style='color:red; margin-bottom:15px;'>Invalid Username!</p>";
            }
        }
        ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <div class="signup-link">
            Don't have an account? <a href="signup.php">Sign Up</a>
        </div>
    </div>
</body>
</html>
