<?php
class ChiTietDangKyModel {
    private $conn;
    private $table_name = "ChiTietDangKy";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Thêm học phần vào bảng ChiTietDangKy
    public function addChiTietDangKy($MaDK, $MaHP) {
        $query = "INSERT INTO " . $this->table_name . " (MaDK, MaHP) VALUES (:MaDK, :MaHP)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$MaDK, $MaHP]);
    }

    // Lấy danh sách học phần mà sinh viên đã đăng ký
    public function getHocPhanBySinhVien($MaSV) {
        $query = "SELECT HP.* FROM HocPhan HP
                  JOIN ChiTietDangKy CT ON HP.MaHP = CT.MaHP
                  JOIN DangKy DK ON DK.MaDK = CT.MaDK
                  WHERE DK.MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$MaSV]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
