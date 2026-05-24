<?php
$conn = new mysqli("127.0.0.1", "admin", "Abc123", "socialnetA");

// Tạo 3 user với mật khẩu gốc đều là '123456'
$users = [
    ['user1', 'Sinh Vien 1', '123456', 'Hoc Web'],
    ['user2', 'Sinh Vien 2', '123456', 'Hoc Security'],
    ['user3', 'Sinh Vien 3', '123456', 'Hoc Network']
];

$stmt = $conn->prepare("INSERT INTO account (username, fullname, password, description) VALUES (?, ?, ?, ?)");

foreach ($users as $u) {
    // SECURITY+ CONCEPT: Luôn HASH mật khẩu bằng thuật toán mạnh (Bcrypt)
    $hashed_password = password_hash($u[2], PASSWORD_DEFAULT);
    $stmt->bind_param("ssss", $u[0], $u[1], $hashed_password, $u[3]);
    $stmt->execute();
}
echo "Đã tạo 3 users thành công!";
?>
