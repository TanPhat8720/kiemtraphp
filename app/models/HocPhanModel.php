<?php
class HocPhanModel {
    private $conn;
    private $table_name = "hocphan";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy danh sách tất cả học phần
    public function getHocPhans() {
        $query = "SELECT MaHP, TenHP, SoTinChi FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    // Lấy thông tin học phần theo mã
    public function getHocPhanById($MaHP) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaHP = :MaHP";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$MaHP]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
