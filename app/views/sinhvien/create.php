<?php include 'app/views/shares/header.php'; ?>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h2>Thêm sinh viên</h2>
            </div>
            <div class="card-body">
                <form action="/trantanphat/SinhVien/save" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="MaSV" class="form-label">Mã SV:</label>
                        <input type="text" name="MaSV" id="MaSV" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="HoTen" class="form-label">Họ Tên:</label>
                        <input type="text" name="HoTen" id="HoTen" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="GioiTinh" class="form-label">Giới Tính:</label>
                        <select name="GioiTinh" id="GioiTinh" class="form-select" required>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="NgaySinh" class="form-label">Ngày Sinh:</label>
                        <input type="date" name="NgaySinh" id="NgaySinh" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="Hinh" class="form-label">Hình ảnh:</label>
                        <input type="file" name="Hinh" id="Hinh" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="MaNganh" class="form-label">Ngành Học:</label>
                        <select name="MaNganh" id="MaNganh" class="form-select" required>
                            <?php foreach ($nganhhoc as $nganh): ?>
                                <option value="<?php echo $nganh->MaNganh ?>">
                                    <?php echo htmlspecialchars($nganh->TenNganh, ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success px-4">Lưu</button>
                        <a href="/trantanphat/SinhVien" class="btn btn-secondary px-4">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
