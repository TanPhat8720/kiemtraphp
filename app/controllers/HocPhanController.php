<?php
session_start();
require_once('app/config/database.php');
require_once('app/models/DangKyModel.php');
require_once('app/models/ChiTietDangKyModel.php');
require_once('app/models/HocPhanModel.php');

class HocPhanController {
    private $dangKyModel;
    private $chiTietDangKyModel;
    private $hocPhanModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->dangKyModel = new DangKyModel($this->db);
        $this->hocPhanModel = new HocPhanModel($this->db);
        $this->chiTietDangKyModel = new ChiTietDangKyModel($this->db);
    }
    public function list() {
        $hocphans = $this->hocPhanModel->getHocPhans();
        include 'app/views/hocphan/list.php';
    }
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $MaSV = $_POST['MaSV'] ?? '';
            $hocPhanIds = $_POST['hocphan'] ?? [];

            if (empty($MaSV) || empty($hocPhanIds)) {
                die("Vui lòng chọn học phần.");
            }

            $dangKy = $this->dangKyModel->getDangKyBySinhVien($MaSV);
            if (!$dangKy) {
                $MaDK = $this->dangKyModel->addDangKy($MaSV);
            } else {
                $MaDK = $dangKy->MaDK;
            }

            foreach ($hocPhanIds as $MaHP) {
                $this->chiTietDangKyModel->addChiTietDangKy($MaDK, $MaHP);
            }

            header('Location: trantanphat/HocPhan/list.php');
        }
    }
}

