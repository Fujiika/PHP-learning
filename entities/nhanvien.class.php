<?php
require_once("config/db.class.php");

class NhanVien
{
    public $Ma_NV;
    public $Ten_NV;
    public $Phai;
    public $Noi_Sinh;
    public $Ma_Phong;
    public $Luong;

    public function __construct($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong)
    {
        $this->Ma_NV = $ma_nv;
        $this->Ten_NV = $ten_nv;
        $this->Phai = $phai;
        $this->Noi_Sinh = $noi_sinh;
        $this->Ma_Phong = $ma_phong;
        $this->Luong = $luong;
    }

    public function save()
    {
        $db = new DB();
        $sql = "INSERT INTO NhanVien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES
        ('$this->Ma_NV', '$this->Ten_NV', '$this->Phai', '$this->Noi_Sinh', '$this->Ma_Phong', '$this->Luong')";
        $result = $db->query_execute($sql);
        return $result;
    }

    public static function list_nhanvien()
    {
        $db = new Db();
        $sql = "SELECT * FROM NhanVien";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public static function get_nhanvien_by_id($ma_nv)
    {
        $db = new DB();
        $sql = "SELECT * FROM NhanVien WHERE Ma_NV = '$ma_nv'";
        $result = $db->select_to_array($sql);
        if (!empty($result)) {
            // Trả về phần tử đầu tiên của mảng, chứa thông tin của nhân viên
            return $result[0];
        } else {
            // Trả về null nếu không tìm thấy nhân viên
            return null;
        }
    }

    public function update()
    {
        $db = new DB();
        $sql = "UPDATE NhanVien SET Ten_NV = '$this->Ten_NV', Phai = '$this->Phai', Noi_Sinh = '$this->Noi_Sinh', 
        Ma_Phong = '$this->Ma_Phong', Luong = '$this->Luong' WHERE Ma_NV = '$this->Ma_NV'";
        $result = $db->query_execute($sql);
        return $result;
    }

    public static function delete_nhanvien($ma_nv)
    {
        $db = new DB();
        $sql = "DELETE FROM NhanVien WHERE Ma_NV = '$ma_nv'";
        $result = $db->query_execute($sql);
        if ($result) {
            // Nếu xóa thành công, chuyển hướng trở lại trang danh sách nhân viên sau 3 giây
            header("Refresh:3; url=list_nhanvien.php");
            echo "Xóa nhân viên thành công.";
        } else {
            echo "Xóa nhân viên thất bại.";
        }
    }

    public static function list_nhanvien_pagination($start, $limit)
    {
        $db = new DB();
        $sql = "SELECT * FROM NhanVien LIMIT $start, $limit";
        $result = $db->select_to_array($sql);
        return $result;
    }
}
