<?php include 'app/views/shares/header.php'; ?>

<body class="bg-light">
    <div class="d-flex align-items-center justify-content-center bg-light">
        <div class="card shadow p-4" style="width: 400px;">
            <h2 class="text-center">Đăng nhập</h2>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger text-center">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php endif; ?>

            <form method="post" action="/trantanphat/Auth/logined">
                <div class="mb-3">
                    <label for="MaSV" class="form-label">Mã sinh viên:</label>
                    <input type="text" name="MaSV" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>