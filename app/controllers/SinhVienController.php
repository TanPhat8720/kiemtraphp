<?php
// Require SessionHelper and other necessary files
require_once('app/config/database.php');
require_once('app/models/SinhVienModel.php');
require_once('app/models/NganhHocModel.php');

class SinhVienController
{


    private $sinhvienModel;
    private $db;
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->sinhvienModel = new SinhVienModel($this->db);
    }
    public function index()
    {
        $sinhviens = $this->sinhvienModel->getSinhViens();
        include 'app/views/sinhvien/index.php';
    }
    public function create()
    {
        $nganhhoc = (new NganhHocModel($this->db))->getNganhHocs();
        include_once 'app/views/sinhvien/create.php';
    }
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $MaSV = $_POST['MaSV'] ?? '';
            $HoTen = $_POST['HoTen'] ?? '';
            $GioiTinh = $_POST['GioiTinh'] ?? '';
            $Hinh = $_FILES['Hinh'] ?? null;
            $NgaySinh = $_POST['NgaySinh'] ?? null;
            $MaNganh = $_POST['MaNganh'] ?? null;

            $errors = [];

            // Kiểm tra dữ liệu đầu vào
            if (empty($MaSV)) {
                $errors[] = 'Mã sinh viên không được để trống';
            }
            if (empty($HoTen)) {
                $errors[] = 'Họ tên không được để trống';
            }
            if (empty($GioiTinh)) {
                $errors[] = 'Giới tính không được để trống';
            }
            if (empty($NgaySinh)) {
                $errors[] = 'Ngày sinh không được để trống';
            }
            if (empty($MaNganh)) {
                $errors[] = 'Mã ngành không được để trống';
            }
            if (!$Hinh || $Hinh['error'] !== 0) {
                $errors[] = 'Vui lòng chọn ảnh sinh viên';
            }

            // Nếu có lỗi, quay lại trang thêm sinh viên
            if (!empty($errors)) {
                $nganhhoc = (new NganhHocModel($this->db))->getNganhHocs();
                include 'app/views/sinhvien/add.php';
                return;
            }

            // Xử lý upload ảnh
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/trantanphat/public/images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $imageName = time() . '_' . basename($Hinh['name']);
            $uploadFile = $uploadDir . $imageName;

            if (!move_uploaded_file($Hinh['tmp_name'], $uploadFile)) {
                die('Lỗi: Không thể di chuyển file ảnh.');
            }

            // Gọi model để lưu sinh viên
            $result = $this->sinhvienModel->addSinhVien($MaSV, $HoTen, $GioiTinh, $NgaySinh, $imageName, $MaNganh);

            if ($result) {
                header('Location: /trantanphat/SinhVien');
            } else {
                $errors[] = 'Lỗi khi thêm sinh viên';
                $nganhhoc = (new NganhHocModel($this->db))->getNganhHocs();
                include 'app/views/sinhvien/add.php';
            }
        }
    }

    public function detail($MaSV)
    {
        $sinhvien = $this->sinhvienModel->getSinhVienById($MaSV);
        if ($sinhvien) {
            include 'app/views/sinhvien/detail.php';
        } else {
            echo "Không tìm thấy sinh viên.";
        }
    }
    public function edit($MaSV)
    {
        $sinhvien = $this->sinhvienModel->getSinhVienById($MaSV);
        if ($sinhvien == null) {
            echo "Không tìm thấy sinh viên";
            return;
        }
        $nganhhoc = (new NganhHocModel($this->db))->getNganhHocs();
        include_once 'app/views/sinhvien/edit.php';
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $MaSV = $_POST['MaSV'] ?? '';
            $HoTen = $_POST['HoTen'] ?? '';
            $GioiTinh = $_POST['GioiTinh'] ?? '';
            $Hinh = $_FILES['Hinh'] ?? null;
            $NgaySinh = $_POST['NgaySinh'] ?? null;
            $MaNganh = $_POST['MaNganh'] ?? null;

            $errors = [];

            // Kiểm tra dữ liệu đầu vào
            if (empty($MaSV)) {
                $errors[] = 'Mã sinh viên không được để trống';
            }
            if (empty($HoTen)) {
                $errors[] = 'Họ tên không được để trống';
            }
            if (empty($GioiTinh)) {
                $errors[] = 'Giới tính không được để trống';
            }
            if (empty($NgaySinh)) {
                $errors[] = 'Ngày sinh không được để trống';
            }
            if (empty($MaNganh)) {
                $errors[] = 'Mã ngành không được để trống';
            }
            if (!$Hinh || $Hinh['error'] !== 0) {
                $errors[] = 'Vui lòng chọn ảnh sinh viên';
            }

            // Nếu có lỗi, quay lại trang thêm sinh viên
            if (!empty($errors)) {
                $nganhhoc = (new NganhHocModel($this->db))->getNganhHocs();
                include 'app/views/sinhvien/edit.php';
                return;
            }

            // Xử lý upload ảnh
            if ($Hinh && $Hinh['error'] === UPLOAD_ERR_OK) {
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/trantanphat/public/images/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $imageName = time() . '_' . basename($Hinh['name']);
                $uploadFile = $uploadDir . $imageName;

                if (!move_uploaded_file($Hinh['tmp_name'], $uploadFile)) {
                    $errors['image'] = 'Lỗi khi tải ảnh lên';
                }
            } else {
                $imageName = $_POST['old_image']; // Giữ ảnh cũ nếu không tải ảnh mới
            }

            // Gọi model để lưu sinh viên
            $result = $this->sinhvienModel->updateSinhVien($MaSV, $HoTen, $GioiTinh, $NgaySinh, $imageName, $MaNganh);
            if (!$result) {
                $errors[] = 'Lỗi khi cập nhật sinh viên';
                $nganhhoc = (new NganhHocModel($this->db))->getNganhHocs();
                include 'app/views/sinhvien/edit.php';
            } else {
                header('Location: /trantanphat/SinhVien');
            }
        }

    }
    public function delete($MaSV)
    {
        $sinhvien = $this->sinhvienModel->getSinhVienById($MaSV);
        if ($sinhvien == null) {
            echo "Không tìm thấy sinh viên";
            return;
        }
        $nganhhoc = (new NganhHocModel($this->db))->getNganhHocs();
        include_once 'app/views/sinhvien/delete.php';
    }
    public function deleted($MaSV)
    {
        $result = $this->sinhvienModel->deleteSinhVien($MaSV);

        if (is_array($result) && isset($result['error'])) {
            echo $result['error'];
            return;
        }

        header('Location: /trantanphat/SinhVien');
    }

}