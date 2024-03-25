<?php
require_once("config/db.class.php");

class PhongBan
{
    public $Ma_Phong;
    public $Ten_Phong;

    public function __construct($ma_phong, $ten_phong)
    {
        $this->Ma_Phong = $ma_phong;
        $this->Ten_Phong = $ten_phong;
    }

    public static function list_phongban()
    {
        $db = new Db();
        $sql = "SELECT * FROM PhongBan";
        $result = $db->select_to_array($sql);
        return $result;
    }
}
