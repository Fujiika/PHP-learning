<?php
require_once("entities/nhanvien.class.php");

// Kiểm tra nếu có tham số "id" được truyền vào URL
if (isset($_GET['id'])) {
    // Lấy mã nhân viên từ tham số truyền vào
    $ma_nv = $_GET['id'];

    // Xóa nhân viên từ cơ sở dữ liệu
    $result = NhanVien::delete_nhanvien($ma_nv);

    // Kiểm tra kết quả
    if ($result) {
        echo "Xóa nhân viên thành công.";
    } else {
        echo "";
    }
} else {
    echo "Mã nhân viên không được cung cấp.";
    exit; // Dừng việc thực thi script
}
