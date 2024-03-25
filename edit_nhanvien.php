<?php
require_once("entities/nhanvien.class.php");
require_once("entities/phongban.class.php");

// Kiểm tra nếu có tham số "id" được truyền vào URL
if (isset($_GET['id'])) {
    // Lấy mã nhân viên từ tham số truyền vào
    $ma_nv = $_GET['id'];

    // Lấy thông tin của nhân viên từ mã nhân viên
    $nhanvien = NhanVien::get_nhanvien_by_id($ma_nv);

    // Lấy danh sách phòng ban
    $phongbans = PhongBan::list_phongban();

    // Kiểm tra xem nhân viên có tồn tại không
    if (!$nhanvien) {
        echo "Nhân viên không tồn tại.";
        exit; // Dừng việc thực thi script
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy thông tin từ form
        $ten_nv = $_POST['ten_nv'];
        $phai = $_POST['phai'];
        $noi_sinh = $_POST['noi_sinh'];
        $ma_phong = $_POST['ma_phong'];
        $luong = $_POST['luong'];

        // Tạo đối tượng NhanVien mới và cập nhật thông tin
        $nhanvien_update = new NhanVien($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong);

        // Cập nhật thông tin nhân viên vào cơ sở dữ liệu
        $result = $nhanvien_update->update();

        // Kiểm tra kết quả
        if ($result) {
            echo "Chỉnh sửa thông tin nhân viên thành công.";
        } else {
            echo "Chỉnh sửa thông tin nhân viên thất bại.";
        }
    }
} else {
    echo "Mã nhân viên không được cung cấp.";
    exit; // Dừng việc thực thi script
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa nhân viên</title>
</head>

<body>
    <h2>Chỉnh sửa thông tin nhân viên</h2>
    <form method="post" action="">
        <input type="hidden" name="ma_nv" value="<?php echo $nhanvien['Ma_NV']; ?>">

        <label for="ten_nv">Tên nhân viên:</label>
        <input type="text" id="ten_nv" name="ten_nv" value="<?php echo $nhanvien['Ten_NV']; ?>" required><br><br>

        <label for="phai">Phái:</label>
        <select id="phai" name="phai">
            <option value="NAM" <?php if ($nhanvien['Phai'] == 'NAM') echo 'selected'; ?>>Nam</option>
            <option value="NU" <?php if ($nhanvien['Phai'] == 'NU') echo 'selected'; ?>>Nữ</option>
        </select><br><br>

        <label for="noi_sinh">Nơi sinh:</label>
        <input type="text" id="noi_sinh" name="noi_sinh" value="<?php echo $nhanvien['Noi_Sinh']; ?>" required><br><br>

        <label for="ma_phong">Mã phòng:</label>
        <select id="ma_phong" name="ma_phong">
            <?php
            foreach ($phongbans as $phongban) {
                echo "<option value='" . $phongban['Ma_Phong'] . "'";
                if ($nhanvien['Ma_Phong'] == $phongban['Ma_Phong']) echo 'selected';
                echo ">" . $phongban['Ten_Phong'] . "</option>";
            }
            ?>
        </select><br><br>

        <label for="luong">Lương:</label>
        <input type="text" id="luong" name="luong" value="<?php echo $nhanvien['Luong']; ?>" required><br><br>

        <input type="submit" value="Lưu chỉnh sửa">
    </form>
    <a href="list_nhanvien.php">Quay lại danh sách nhân viên</a>
</body>

</html>