<nav>
    <a href="index.php">Home</a>
    <a href="profile.php">Profile</a>
    <a href="setting.php">Settings</a>
    <a href="about.php">About</a>
    
    <?php 
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        echo '<a href="admin_newuser.php" style="color: #ffcc00;">New User</a>';
    }
    ?>
    
    <a href="signout.php">Logout</a>
</nav>
