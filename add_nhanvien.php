<?php
// Kết nối cơ sở dữ liệu và thực hiện truy vấn để lấy tên phòng
// Include file class NhanVien và PhongBan
require_once("entities/nhanvien.class.php");
require_once("entities/phongban.class.php");

// Nếu người dùng đã gửi form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ form
    $ma_nv = $_POST['ma_nv'];
    $ten_nv = $_POST['ten_nv'];
    $phai = $_POST['phai'];
    $noi_sinh = $_POST['noi_sinh'];
    $ma_phong = $_POST['ma_phong'];
    $luong = $_POST['luong'];

    // Tạo đối tượng NhanVien mới
    $nhanvien = new NhanVien($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong);

    // Lưu thông tin nhân viên vào cơ sở dữ liệu
    $result = $nhanvien->save();

    // Kiểm tra kết quả
    if ($result) {
        echo "Thêm nhân viên thành công.";
    } else {
        echo "Thêm nhân viên thất bại.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm nhân viên</title>
</head>

<body>
    <h2>Thêm nhân viên</h2>
    <form method="post" action="">
        <label for="ma_nv">Mã nhân viên:</label>
        <input type="text" id="ma_nv" name="ma_nv" required><br><br>

        <label for="ten_nv">Tên nhân viên:</label>
        <input type="text" id="ten_nv" name="ten_nv" required><br><br>

        <label for="phai">Phái:</label>
        <select id="phai" name="phai">
            <option value="NAM">Nam</option>
            <option value="NU">Nữ</option>
        </select><br><br>

        <label for="noi_sinh">Nơi sinh:</label>
        <input type="text" id="noi_sinh" name="noi_sinh" required><br><br>

        <label for="ma_phong">Mã phòng:</label>
        <select id="ma_phong" name="ma_phong">
            <?php
            // Lấy danh sách phòng ban từ cơ sở dữ liệu
            $phongbans = PhongBan::list_phongban();

            // Hiển thị danh sách phòng ban trong một dropdown
            foreach ($phongbans as $phongban) {
                echo "<option value='" . $phongban['Ma_Phong'] . "'>" . $phongban['Ten_Phong'] . "</option>";
            }
            ?>
        </select><br><br>

        <label for="luong">Lương:</label>
        <input type="text" id="luong" name="luong" required><br><br>

        <input type="submit" value="Thêm nhân viên">
    </form>
    <a href="list_nhanvien.php">Quay lại danh sách nhân viên</a>

</body>

</html>