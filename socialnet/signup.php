<?php
require_once '../db.php';

$message = "";
$message_type = "";
$clear_inputs = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // 1. Check if passwords match
    if ($password !== $confirm_password) {
        $message = "Passwords do not match!";
        $message_type = "error";
        $clear_inputs = true; // Trigger clearing inputs
    } else {
        // 2. Check if username is already taken
        // (Vulnerable SQL for lab purposes)
        $check_sql = "SELECT id FROM account WHERE username = '$username'";
        $check_res = db_query($check_sql);

        if ($check_res && $check_res->num_rows > 0) {
            $message = "Error: Username '$username' is already taken. Please choose another.";
            $message_type = "error";
            $clear_inputs = true; // Trigger clearing inputs
        } else {
            // FIX: Mã hóa mật khẩu bằng Bcrypt trước khi lưu xuống database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // 3. Insert new user với mật khẩu đã được băm ($hashed_password)
            $sql = "INSERT INTO account (username, password, fullname) VALUES ('$username', '$hashed_password', '$fullname')";
            if (db_query($sql)) {
                $message = "Account created successfully! You can now sign in.";
                $message_type = "success";
            } else {
                $message = "System error. Please try again later.";
                $message_type = "error";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - SocialNet</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .auth-card {
            background: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h2 { color: #1c1e21; margin-bottom: 5px; }
        p.desc { color: #606770; margin-bottom: 25px; font-size: 14px; }
        .form-group { text-align: left; margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: 600; color: #4b4f56; font-size: 13px; }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #dddfe2;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 15px;
        }
        .alert {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .error { background-color: #ffebe9; border: 1px solid #ff8182; color: #ce372b; }
        .success { background-color: #e7f3ff; border: 1px solid #1877f2; color: #1877f2; }
        .btn-signup {
            width: 100%;
            padding: 12px;
            background-color: #42b72a;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn-signup:hover { background-color: #36a420; }
        .auth-footer {
            margin-top: 20px;
            border-top: 1px solid #dddfe2;
            padding-top: 15px;
            font-size: 14px;
        }
        .auth-footer a { color: #a00; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

    <div class="auth-card">
        <h2>Create Account</h2>
        <p class="desc">Join SocialNet today.</p>

        <?php if($message): ?>
            <div class="alert <?php echo $message_type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form id="signupForm" method="POST" action="">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="fullname" id="fullname" required value="<?php echo (!$clear_inputs && isset($_POST['fullname'])) ? htmlspecialchars($_POST['fullname']) : ''; ?>">
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" id="username" required value="<?php echo (!$clear_inputs && isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : ''; ?>">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>

            <button type="submit" class="btn-signup">Sign Up</button>
        </form>

        <div class="auth-footer">
            Already have an account? <a href="signin.php">Sign In</a>
        </div>
    </div>

    <?php if ($clear_inputs): ?>
    <script>
        // Clear sensitive or duplicate inputs on error
        document.getElementById('username').value = "";
        document.getElementById('password').value = "";
        document.getElementById('confirm_password').value = "";
        // Keep focus on username for re-entry
        document.getElementById('username').focus();
    </script>
    <?php endif; ?>

</body>
</html>
