<?php
session_start();
require_once '../db.php';

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

$username = $_SESSION['username'];
$fullname = "";

// Fetch current user details from the database
$me_res = db_query("SELECT fullname FROM account WHERE id = " . $_SESSION['user_id']);
if ($me_res && $row = $me_res->fetch_assoc()) {
    $fullname = $row['fullname'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - SocialNet</title>
    <style>
        html, body { margin: 0; padding: 0; background-color: #ffffff; font-family: Arial, sans-serif; }
        nav { background-color: #555; padding: 12px 0; text-align: center; width: 100%; }
        nav a { color: white; text-decoration: none; margin: 0 15px; font-weight: bold; }
        .container { text-align: center; margin-top: 40px; }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <div style="background: #f9f9f9; padding: 20px; display: inline-block; border: 1px solid #ddd; border-radius: 8px;">
            <h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>
            <p><strong>Full Name:</strong> <?php echo htmlspecialchars($fullname); ?></p>
        </div>

        <h2 style="margin-top: 40px; color: #888; font-size: 14px; text-transform: uppercase;">Other Users</h2>
        <div style="width: 60%; margin: 0 auto; text-align: left;">
            <?php
            $res = db_query("SELECT username, fullname FROM account WHERE id != " . $_SESSION['user_id']);
            if ($res) {
                while($row = $res->fetch_assoc()) {
                    echo "<div style='display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee;'>
                            <span>" . htmlspecialchars($row['username']) . " - <strong>" . htmlspecialchars($row['fullname']) . "</strong></span>
                            <a href='profile.php?owner=" . urlencode($row['username']) . "' style='color: #a00; text-decoration: none;'>View Profile</a>
                          </div>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
