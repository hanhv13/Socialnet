<?php require_once '../db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>SocialNet - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2 style="text-align:center">Welcome to SocialNet</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $_POST['username'];
            $pass = $_POST['password'];
            // VULNERABLE: Direct string concatenation
            $sql = "SELECT * FROM account WHERE username = '$user' AND password = '$pass'";
            $result = db_query($sql);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                header("Location: index.php");
            } else { echo "<p style='color:red'>Invalid Login!</p>"; }
        }
        ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
