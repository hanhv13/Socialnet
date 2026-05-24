<?php 
session_start();
require_once '../db.php'; 

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Access Denied: Only Admin can access this page!");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <style>
        html, body { margin: 0; padding: 0; background-color: #ffffff; font-family: Arial, sans-serif; }
        body { display: flex; justify-content: center; align-items: center; height: 100vh; }
        .container { text-align: center; background: #f9f9f9; padding: 30px; border: 1px solid #ddd; border-radius: 8px; width: 100%; max-width: 360px; }
        h2 { color: #333; margin-bottom: 5px; }
        .subtitle { color: #888; font-size: 12px; text-transform: uppercase; margin-bottom: 20px; }
        input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #444; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; }
        button:hover { background-color: #222; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Panel</h2>
        <div class="subtitle">Register New ADMIN Account</div>
        <form method="POST">
            <input type="text" name="u" placeholder="Admin Username" required>
            <input type="text" name="f" placeholder="Full Name" required>
            <input type="password" name="p" placeholder="Password" required>
            <button type="submit">Create Account</button>
        </form>
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $u = $_POST['u'];
            $f = $_POST['f'];
            $p = $_POST['p'];

            $sql = "INSERT INTO account (username, fullname, password, role) VALUES ('$u', '$f', '$p', 'admin')";
            if(db_query($sql)) {
                echo "<p style='color: green; margin-top: 15px;'>User Created!</p>";
            } else {
                echo "<p style='color: red; margin-top: 15px;'>Error creating account.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
