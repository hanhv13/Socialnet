<?php require_once '../db.php'; ?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="../socialnet/style.css"></head>
<body>
    <div class="container">
        <h2>Admin: Register New User</h2>
        <form method="POST">
            <input type="text" name="u" placeholder="Username" required>
            <input type="text" name="f" placeholder="Full Name" required>
            <input type="password" name="p" placeholder="Password" required>
            <button type="submit">Create Account</button>
        </form>
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sql = "INSERT INTO account (username, fullname, password) VALUES ('{$_POST['u']}', '{$_POST['f']}', '{$_POST['p']}')";
            if(db_query($sql)) echo "<p>User Created!</p>";
        }
        ?>
    </div>
</body>
</html>
