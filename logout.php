<?php
// Bắt đầu session
session_start();

// Xóa bỏ tất cả các session
session_unset();

// Hủy bỏ session
session_destroy();

// Chuyển hướng người dùng đến trang đăng nhập hoặc trang chính
header("Location: login.php");
exit;
