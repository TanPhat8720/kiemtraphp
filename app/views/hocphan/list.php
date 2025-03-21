<?php include 'app/views/shares/header.php'; ?>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Chào, <?= htmlspecialchars($_SESSION['HoTen']) ?></h2>
            <a href="/trantanphat/Auth/logout" class="btn btn-danger">Đăng xuất</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Danh sách học phần</h4>
            </div>
            <div class="card-body">
                <form method="post" action="register">
                    <input type="hidden" name="MaSV" value="<?= htmlspecialchars($_SESSION['MaSV']) ?>">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Chọn</th>
                                <th>Mã HP</th>
                                <th>Tên HP</th>
                                <th>Số tín chỉ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($hocphans as $hp): ?>
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="hocphan[]" value="<?= htmlspecialchars($hp->MaHP) ?>">
                                    </td>
                                    <td><?= htmlspecialchars($hp->MaHP) ?></td>
                                    <td><?= htmlspecialchars($hp->TenHP) ?></td>
                                    <td><?= htmlspecialchars($hp->SoTinChi) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Đăng ký</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
