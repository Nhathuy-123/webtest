<?php
session_start(); // Bắt đầu session

// Hủy session để đăng xuất
session_unset();
session_destroy();

// Chuyển hướng về trang index.html
header('Location: index.html');
exit();
?>
