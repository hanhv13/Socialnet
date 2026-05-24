<?php
session_start();
require_once '../db.php';

// Authentication check
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

// Fetch owner profile
$owner = $_GET['owner'] ?? $_SESSION['username'];

// FIX: Sử dụng Prepared Statement để chống SQL Injection
$stmt = $conn->prepare("SELECT id, username, fullname, password, role, description FROM account WHERE username = ?");
$stmt->bind_param("s", $owner);
$stmt->execute();

$res = $stmt->get_result();
$user = $res->fetch_assoc();

$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile: <?php echo htmlspecialchars($owner); ?></title>
    <style>
        /* Reset and Header Styles to match the image */
        html, body {
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            font-family: Arial, sans-serif;
        }

        /* Dark Header/MenuBar style */
        nav {
            background-color: #555;
            padding: 12px 0;
            text-align: center;
            width: 100%;
            display: block;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 16px;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            text-align: center;
            margin-top: 40px;
        }

        .user-card {
            background: #f9f9f9;
            padding: 20px;
            display: inline-block;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: left;
            min-width: 300px;
            margin-top: 20px;
        }

        .bio-box {
            background: #eee;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 10px;
            min-height: 50px;
            color: #000000;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <h1>Profile: <?php echo htmlspecialchars($owner); ?></h1>

        <div class="user-card">
            <h3>Full Name: <?php echo htmlspecialchars($user['fullname'] ?? 'Unknown'); ?></h3>
            <p><strong>Bio:</strong></p>

            <div class="bio-box">
                <?php echo $user['description'] ?? 'No bio yet.'; ?>
            </div>
        </div>
    </div>
</body>
</html>

<div class="bio-box">
    <?php echo htmlspecialchars($user['description'] ?? 'No bio yet.', ENT_QUOTES, 'UTF-8'); ?>
</div>
