<?php
session_start(); // Bắt đầu session

require_once("entities/nhanvien.class.php");

// $nhanviens = NhanVien::list_nhanvien();
require_once("entities/nhanvien.class.php");


$record_per_page = 5;

$total_records = count(NhanVien::list_nhanvien());
$total_pages = ceil($total_records / $record_per_page);


$current_page = isset($_GET['page']) ? $_GET['page'] : 1;


$start = ($current_page - 1) * $record_per_page;
$nhanviens = NhanVien::list_nhanvien_pagination($start, $record_per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên</title>
</head>

<body>
    <!-- Hiển thị thông báo chào mừng -->
    <?php if (isset($_SESSION['fullname'])) : ?>
        <h2>Welcome <?php echo $_SESSION['fullname']; ?></h2>
    <?php endif; ?>
    <!-- Hiển thị nút Logout -->
    <a href="logout.php"><button>Logout</button></a>


    <h2>Danh sách nhân viên</h2>
    <!-- Kiểm tra role để hiển thị hoặc ẩn nút thêm nhân viên -->
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>
        <button onclick="window.location.href='add_nhanvien.php'">Thêm nhân viên</button>
    <?php endif; ?>
    <table border="1">
        <tr>
            <th>Mã NV</th>
            <th>Tên NV</th>
            <th>Phái</th>
            <th>Nơi Sinh</th>
            <th>Mã Phòng</th>
            <th>Lương</th>
            <!-- Kiểm tra role để hiển thị hoặc ẩn cột chức năng -->
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>
                <th>Action</th>
            <?php endif; ?>
        </tr>
        <?php foreach ($nhanviens as $nhanvien) : ?>
            <tr>
                <td><?php echo $nhanvien['Ma_NV']; ?></td>
                <td><?php echo $nhanvien['Ten_NV']; ?></td>
                <td style="text-align: center;">
                    <?php

                    if ($nhanvien['Phai'] == 'NAM') {
                        echo '<img src="img/man.png" alt="Nam" width="20" height="20">';
                    } elseif ($nhanvien['Phai'] == 'NU') {
                        echo '<img src="img/woman.png" alt="Nữ" width="20" height="20">';
                    }
                    ?>
                </td>
                <td><?php echo $nhanvien['Noi_Sinh']; ?></td>
                <td><?php echo $nhanvien['Ma_Phong']; ?></td>
                <td><?php echo $nhanvien['Luong']; ?></td>
                <!-- Kiểm tra role để hiển thị hoặc ẩn nút edit và delete -->
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>
                    <td>
                        <a href="edit_nhanvien.php?id=<?php echo $nhanvien['Ma_NV']; ?>"><img src="img/edit.png" alt="Edit" width="20" height="20"></a>
                        <a href="delete_nhanvien.php?id=<?php echo $nhanvien['Ma_NV']; ?>" onclick="return confirm('Bạn có chắc muốn xóa nhân viên này?');"><img src="img/delete.png" alt="Delete" width="20" height="20"></a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    <!--Phân trang -->
    <?php if ($total_pages > 1) : ?>
        <div>
            <?php if ($current_page > 1) : ?>
                <a href="?page=<?php echo $current_page - 1; ?>"><button>Prev</button></a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <a href="?page=<?php echo $i; ?>"><button><?php echo $i; ?></button></a>
            <?php endfor; ?>

            <?php if ($current_page < $total_pages) : ?>
                <a href="?page=<?php echo $current_page + 1; ?>"><button>Next</button></a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>

</html>