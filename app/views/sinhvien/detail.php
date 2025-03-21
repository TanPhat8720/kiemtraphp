<?php include 'app/views/shares/header.php'; ?>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h2>Chi tiết Sinh Viên</h2>
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                <img src="/trantanphat/public/images/<?php echo $sinhvien->Hinh; ?>" 
                alt="Hình ảnh" class="img-thumbnail" width="150">
                </div>
                <p><strong>Mã SV:</strong> <?= htmlspecialchars($sinhvien->MaSV, ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Họ Tên:</strong> <?= htmlspecialchars($sinhvien->HoTen, ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Giới Tính:</strong> <?= htmlspecialchars($sinhvien->GioiTinh, ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Ngày Sinh:</strong> <?= htmlspecialchars($sinhvien->NgaySinh, ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Ngành Học:</strong> <?= htmlspecialchars($sinhvien->MaNganh, ENT_QUOTES, 'UTF-8') ?></p>
                <a href="/trantanphat/SinhVien" class="btn btn-secondary mt-3">Quay lại</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
