<?php include 'app/views/shares/header.php'; ?>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-warning text-white text-center">
                <h2>Sửa Sinh Viên</h2>
            </div>
            <div class="card-body">
                <form action="/trantanphat/SinhVien/update" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="MaSV" value="<?= htmlspecialchars($sinhvien->MaSV, ENT_QUOTES, 'UTF-8') ?>">
                    
                    <div class="mb-3">
                        <label for="HoTen" class="form-label">Họ Tên:</label>
                        <input type="text" name="HoTen" id="HoTen" class="form-control" 
                               value="<?= htmlspecialchars($sinhvien->HoTen, ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="GioiTinh" class="form-label">Giới Tính:</label>
                        <select name="GioiTinh" id="GioiTinh" class="form-select" required>
                            <option value="Nam" <?= $sinhvien->GioiTinh == 'Nam' ? 'selected' : '' ?>>Nam</option>
                            <option value="Nữ" <?= $sinhvien->GioiTinh == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="NgaySinh" class="form-label">Ngày Sinh:</label>
                        <input type="date" name="NgaySinh" id="NgaySinh" class="form-control" 
                               value="<?= htmlspecialchars($sinhvien->NgaySinh, ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="Hinh" class="form-label">Hình:</label>
                        <input type="file" name="Hinh" id="Hinh" class="form-control">
                        <input type="hidden" name="old_image" value="<?= htmlspecialchars($sinhvien->Hinh, ENT_QUOTES, 'UTF-8') ?>">
                        <?php if (!empty($sinhvien->Hinh)): ?>
                            <div class="mt-2">
                                <img src="/public/images/<?= htmlspecialchars($sinhvien->Hinh, ENT_QUOTES, 'UTF-8') ?>" 
                                     alt="Hình ảnh sinh viên" class="img-thumbnail" width="100">
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="MaNganh" class="form-label">Ngành Học:</label>
                        <select name="MaNganh" id="MaNganh" class="form-select" required>
                            <?php foreach ($nganhhoc as $nganh): ?>
                                <option value="<?= htmlspecialchars($nganh->MaNganh, ENT_QUOTES, 'UTF-8') ?>" 
                                        <?= $nganh->MaNganh == $sinhvien->MaNganh ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($nganh->TenNganh, ENT_QUOTES, 'UTF-8') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success px-4">Cập nhật</button>
                        <a href="/trantanphat/SinhVien" class="btn btn-secondary px-4">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
