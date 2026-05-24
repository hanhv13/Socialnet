<?php
mysqli_report(MYSQLI_REPORT_OFF);

$servername = "127.0.0.1";
$username = "root";
$password = "root"; // Tạm thời để trống theo cách "chữa cháy" không mật khẩu ở bước trước, hoặc điền đúng mật khẩu root của bạn
$dbname = "socialnet"; // Hãy chắc chắn database này đã được tạo trong MySQL

$conn = @new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}

if (!function_exists('db_query')) {
    function db_query($sql) {
        global $conn;
        return $conn->query($sql);
    }
}
?>
