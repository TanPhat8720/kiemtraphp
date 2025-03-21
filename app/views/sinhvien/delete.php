<?php include 'app/views/shares/header.php'; ?>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-danger text-white text-center">
                <h2>Xóa Sinh Viên</h2>
            </div>
            <div class="card-body text-center">
                <h4>Bạn có chắc chắn muốn xóa sinh viên này không?</h4>
                <div class="mt-4">
                    <img src="<?= htmlspecialchars($sinhvien->Hinh, ENT_QUOTES, 'UTF-8') ?>" alt="Hình ảnh sinh viên" class="img-thumbnail" width="150">
                </div>
                <p class="mt-3"><strong>Mã Sinh Viên:</strong> <?= htmlspecialchars($sinhvien->MaSV, ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Họ Tên:</strong> <?= htmlspecialchars($sinhvien->HoTen, ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Giới Tính:</strong> <?= htmlspecialchars($sinhvien->GioiTinh, ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Ngày Sinh:</strong> <?= htmlspecialchars($sinhvien->NgaySinh, ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Ngành Học:</strong> <?= htmlspecialchars($sinhvien->MaNganh, ENT_QUOTES, 'UTF-8') ?></p>
                
                <form action="/trantanphat/SinhVien/deleted/<?= htmlspecialchars($sinhvien->MaSV, ENT_QUOTES, 'UTF-8') ?>" method="post" class="mt-4">
                    <button type="submit" class="btn btn-danger px-4">Xóa</button>
                    <a href="/trantanphat/SinhVien" class="btn btn-secondary px-4">Hủy</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
