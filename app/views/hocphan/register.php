<?php include 'app/views/shares/header.php'; ?>
<body>
    <h1>Đăng ký học phần</h1>
    <form method="post" action="/trantanphat/HocPhan/saveRegistration">
        <input type="hidden" name="MaSV" value="<?= $MaSV ?>">
        <table border="1">
            <tr>
                <th>Chọn</th>
                <th>Mã HP</th>
                <th>Tên HP</th>
                <th>Số tín chỉ</th>
            </tr>
            <?php foreach ($hocphans as $hp): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="hocphan[]" value="<?= $hp->MaHP ?>" 
                            <?= in_array($hp->MaHP, array_column($hocPhanDaDangKy, 'MaHP')) ? 'checked disabled' : '' ?>>
                    </td>
                    <td><?= $hp->MaHP ?></td>
                    <td><?= $hp->TenHP ?></td>
                    <td><?= $hp->SoTinChi ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <button type="submit">Đăng ký</button>
    </form>
</body>
</html>
