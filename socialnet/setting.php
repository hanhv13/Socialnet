<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['user_id']) && !isset($_SESSION['id'])) {
    header("Location: signin.php");
    exit();
}

$msg = "";
$uid = $_SESSION['user_id'] ?? $_SESSION['id'] ?? 0;
$uid = (int)$uid;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $desc = $_POST['description'];

    $update_sql = "UPDATE account SET description = '$desc' WHERE id = $uid";
    
    if (db_query($update_sql)) {
        $msg = "Profile updated successfully!";
    } else {
        $msg = "Error updating profile.";
    }
}

$current_desc = "";
$res = db_query("SELECT description FROM account WHERE id = $uid");
if ($res && $row = $res->fetch_assoc()) {
    $current_desc = $row['description'] ?? "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings - SocialNet</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            font-family: Arial, sans-serif;
        }
        nav {
            background-color: #555;
            padding: 15px 0;
            text-align: center;
            width: 100%;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .container {
            text-align: center;
            margin-top: 50px;
        }
        .form-box {
            display: inline-block;
            width: 80%;
            max-width: 600px;
            text-align: left;
        }
        textarea {
            width: 100%;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            margin-top: 10px;
            box-sizing: border-box;
        }
        button {
            margin-top: 15px;
            padding: 10px 25px;
            background-color: #444;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #222;
        }
        .alert {
            color: green;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <div class="form-box">
            <h2>Edit Your Bio</h2>

            <?php if($msg != "") echo "<div class='alert'>$msg</div>"; ?>

            <form method="POST">
                <label for="description">Personal Description:</label>
                <textarea name="description" id="description" rows="8"><?php echo htmlspecialchars($current_desc); ?></textarea>
                <button type="submit">Update Profile</button>
            </form>
        </div>
    </div>
</body>
</html>
