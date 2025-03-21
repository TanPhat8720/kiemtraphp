<?php include 'app/views/shares/header.php'; ?>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Danh sách sinh viên</h2>
            <a href="/trantanphat/SinhVien/create" class="btn btn-warning">➕ Thêm sinh viên</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Mã SV</th>
                        <th>Họ Tên</th>
                        <th>Giới Tính</th>
                        <th>Ngày Sinh</th>
                        <th>Hình</th>
                        <th>Ngành Học</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sinhviens as $sinhvien): ?>
                    <tr>
                        <td><?= htmlspecialchars($sinhvien->MaSV, ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($sinhvien->HoTen, ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($sinhvien->GioiTinh, ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($sinhvien->NgaySinh, ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                            <img src="/trantanphat/public/images/<?php echo $sinhvien->Hinh; ?>" 
                                 alt="Hình ảnh" class="img-thumbnail" width="50">
                        </td>
                        <td><?= htmlspecialchars($sinhvien->TenNganh, ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                            <a href="/trantanphat/SinhVien/detail/<?= $sinhvien->MaSV ?>" class="btn btn-info btn-sm">👀 Chi tiết</a>
                            <a href="/trantanphat/SinhVien/edit/<?= $sinhvien->MaSV ?>" class="btn btn-success btn-sm">✏️ Sửa</a>
                            <a href="/trantanphat/SinhVien/delete/<?= $sinhvien->MaSV ?>" class="btn btn-danger btn-sm">🗑️ Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
