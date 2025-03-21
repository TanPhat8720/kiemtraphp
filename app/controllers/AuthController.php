<?php
session_start();
require_once('app/config/database.php');

class AuthController {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    public function login() {
        include('app/views/auth/login.php');
    }
    public function logined() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $MaSV = $_POST['MaSV'] ?? '';

            $query = "SELECT * FROM SinhVien WHERE MaSV = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$MaSV]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);

            if ($user) {
                $_SESSION['MaSV'] = $user->MaSV;
                $_SESSION['HoTen'] = $user->HoTen;
                header('Location: /trantanphat/HocPhan/list');
                exit();
            } else {
                header('Location: login.php?error=Thông tin không hợp lệ!');
                exit();
            }
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /trantanphat/Auth/login');
        exit();
    }
}

