<?php
class NganhHocModel {
    private $conn;
    private $table_name = "nganhhoc";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy danh sách tất cả ngành học
    public function getNganhHocs() {
        $query = "SELECT MaNganh, TenNganh FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Lấy thông tin ngành học theo mã ngành
    public function getNganhHocById($MaNganh) {
        $query = "SELECT MaNganh, TenNganh FROM " . $this->table_name . " WHERE MaNganh = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$MaNganh]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Thêm ngành học mới
    public function addNganhHoc($MaNganh, $TenNganh) {
        $query = "INSERT INTO " . $this->table_name . " (MaNganh, TenNganh) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$MaNganh, $TenNganh]);
    }

    // Cập nhật thông tin ngành học
    public function updateNganhHoc($MaNganh, $TenNganh) {
        $query = "UPDATE " . $this->table_name . " SET TenNganh = ? WHERE MaNganh = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$TenNganh, $MaNganh]);
    }

    // Xóa ngành học
    public function deleteNganhHoc($MaNganh) {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaNganh = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$MaNganh]);
    }
}
