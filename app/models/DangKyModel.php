<?php
class DangKyModel {
    private $conn;
    private $table_name = "DangKy";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Thêm bản ghi đăng ký học phần
    public function addDangKy($MaSV) {
        $query = "INSERT INTO " . $this->table_name . " (NgayDK, MaSV) VALUES (NOW(), :MaSV)";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute([$MaSV])) {
            return $this->conn->lastInsertId(); // Trả về ID của bản ghi vừa tạo
        }
        return false;
    }

    // Kiểm tra xem sinh viên đã đăng ký chưa
    public function getDangKyBySinhVien($MaSV) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaSV = :MaSV";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$MaSV]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
