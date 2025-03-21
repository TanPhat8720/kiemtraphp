<?php
require_once('app/config/database.php');
require_once('app/models/NganhHocModel.php');

class NganhHocController {
    private $nganhhocModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->nganhhocModel = new NganhHocModel($this->db);
    }

    // Hiển thị danh sách ngành học
    public function index() {
        $nganhhocs = $this->nganhhocModel->getNganhHocs();
        include 'app/views/nganhhoc/index.php';
    }

    // Hiển thị form thêm ngành học
    public function create() {
        include 'app/views/nganhhoc/create.php';
    }

    // Xử lý thêm ngành học
    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $MaNganh = $_POST['MaNganh'] ?? '';
            $TenNganh = $_POST['TenNganh'] ?? '';

            $errors = [];

            if (empty($MaNganh)) {
                $errors[] = 'Mã ngành không được để trống';
            }
            if (empty($TenNganh)) {
                $errors[] = 'Tên ngành không được để trống';
            }

            if (!empty($errors)) {
                include 'app/views/nganhhoc/create.php';
                return;
            }

            if ($this->nganhhocModel->addNganhHoc($MaNganh, $TenNganh)) {
                header('Location: /trantanphat/NganhHoc');
            } else {
                $errors[] = 'Lỗi khi thêm ngành học';
                include 'app/views/nganhhoc/create.php';
            }
        }
    }

    // Hiển thị thông tin ngành học theo ID
    public function detail($MaNganh) {
        $nganhhoc = $this->nganhhocModel->getNganhHocById($MaNganh);
        if ($nganhhoc) {
            include 'app/views/nganhhoc/detail.php';
        } else {
            echo "Không tìm thấy ngành học.";
        }
    }

    // Hiển thị form chỉnh sửa ngành học
    public function edit($MaNganh) {
        $nganhhoc = $this->nganhhocModel->getNganhHocById($MaNganh);
        if ($nganhhoc == null) {
            echo "Không tìm thấy ngành học";
            return;
        }
        include 'app/views/nganhhoc/edit.php';
    }

    // Xử lý cập nhật ngành học
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $MaNganh = $_POST['MaNganh'] ?? '';
            $TenNganh = $_POST['TenNganh'] ?? '';

            $errors = [];

            if (empty($MaNganh)) {
                $errors[] = 'Mã ngành không được để trống';
            }
            if (empty($TenNganh)) {
                $errors[] = 'Tên ngành không được để trống';
            }

            if (!empty($errors)) {
                include 'app/views/nganhhoc/edit.php';
                return;
            }

            if ($this->nganhhocModel->updateNganhHoc($MaNganh, $TenNganh)) {
                header('Location: /trantanphat/NganhHoc');
            } else {
                $errors[] = 'Lỗi khi cập nhật ngành học';
                include 'app/views/nganhhoc/edit.php';
            }
        }
    }

    // Hiển thị trang xác nhận xóa ngành học
    public function delete($MaNganh) {
        $nganhhoc = $this->nganhhocModel->getNganhHocById($MaNganh);
        if ($nganhhoc == null) {
            echo "Không tìm thấy ngành học";
            return;
        }
        include 'app/views/nganhhoc/delete.php';
    }

    // Xử lý xóa ngành học
    public function deleted($MaNganh) {
        if ($this->nganhhocModel->deleteNganhHoc($MaNganh)) {
            header('Location: /trantanphat/NganhHoc');
        } else {
            echo "Lỗi khi xóa ngành học.";
        }
    }
}
