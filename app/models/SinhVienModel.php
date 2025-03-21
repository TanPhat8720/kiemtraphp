<?php
class SinhVienModel{
    private $conn;
    private $table_name = "sinhvien";
    public function __construct($db){
        $this->conn = $db;
    }
    public function getSinhViens(){
        $query = "SELECT MaSV, HoTen, GioiTinh, NgaySinh, Hinh, p.TenNganh FROM " . $this->table_name ." LEFT JOIN nganhhoc p ON sinhvien.MaNganh = p.MaNganh";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public function getSinhVienById($MaSV){
        $query = "SELECT MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh FROM " . $this->table_name . " WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $MaSV);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public function addSinhVien($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh){
        $errors = [];
        if($MaSV == ""){
            $errors['MaSV'] = 'Mã sinh viên không được để trống';
        }
        if($HoTen == ''){
            $errors['HoTen'] = 'Họ tên không được để trống';
        }
        if($GioiTinh == ''){
            $errors['GioiTinh'] = 'Giới tính không được để trống';
        }
        if($NgaySinh==''){
            $errors['NgaySinh'] = 'Ngày sinh không được để trống';
        }
        if($Hinh==''){
            $errors['Hinh'] = 'Hình không được để trống';
        }
        if($MaNganh== ''){
            $errors['MaNganh'] = 'Mã ngành không được để trống';
        }
        if(count($errors) > 0){
            return $errors;
        }
        $query = 'INSERT INTO sinhvien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (:MaSV, :HoTen, :GioiTinh, :NgaySinh, :Hinh, :MaNganh)';
        $stmt = $this->conn->prepare($query);
        $stmt-> bindParam(":MaSV", $MaSV);
        $stmt->bindParam(":HoTen", $HoTen);
        $stmt->bindParam(":GioiTinh", $GioiTinh);
        $stmt->bindParam(":NgaySinh", $NgaySinh);
        $stmt->bindParam(":Hinh", $Hinh);
        $stmt->bindParam(":MaNganh", $MaNganh);
        return $stmt->execute();
    }

    public function updateSinhVien($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh){
        $query = "UPDATE " . $this->table_name . " 
              SET HoTen=:HoTen, GioiTinh=:GioiTinh, NgaySinh=:NgaySinh, Hinh=:Hinh, MaNganh=:MaNganh 
              WHERE MaSV=:MaSV";
    $stmt = $this->conn->prepare($query);

    $MaSV = htmlspecialchars(strip_tags($MaSV));
    $HoTen = htmlspecialchars(strip_tags($HoTen));
    $GioiTinh = htmlspecialchars(strip_tags($GioiTinh));
    $NgaySinh = htmlspecialchars(strip_tags($NgaySinh));
    $Hinh = htmlspecialchars(strip_tags($Hinh));
    $MaNganh = htmlspecialchars(strip_tags($MaNganh));

    $stmt->bindParam(':MaSV', $MaSV);
    $stmt->bindParam(':HoTen', $HoTen);
    $stmt->bindParam(':GioiTinh', $GioiTinh);
    $stmt->bindParam(':NgaySinh', $NgaySinh);
    $stmt->bindParam(':Hinh', $Hinh);
    $stmt->bindParam(':MaNganh', $MaNganh);

    if ($stmt->execute()) {
        return true;
    }

    return false;
    }
    public function deleteSinhVien($MaSV){
        $query = "DELETE FROM " . $this->table_name . " WHERE MaSV = :MaSV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":MaSV", $MaSV);
        if( $stmt->execute() ){
            return true;
        }
        return false;
    }
}