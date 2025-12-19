<?php
/**
 * LOGIN MODULE - Module/user/login.php
 */

// 1. Cek jika sudah login
if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true) {
    header('Location: ' . BASE_URL . 'artikel/index');
    exit;
}

$message = "";

// 2. Logika Proses Login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $db->conn->real_escape_string(trim($_POST['username']));
    $password = $_POST['password'];

    // Menggunakan method query dari object $db global
    $sql = "SELECT * FROM users WHERE username = '{$username}' LIMIT 1";
    $result = $db->query($sql);
    
    if (!$result) {
        $message = "Terjadi kesalahan pada query database.";
    } else {
        $data = $result->fetch_assoc();

        if ($data) {
            if (password_verify($password, $data['password'])) {
                // Login Berhasil
                session_regenerate_id(true);
                $_SESSION['is_login'] = true;
                $_SESSION['username'] = $data['username'];
                $_SESSION['nama']     = $data['nama'];

                header('Location: ' . BASE_URL . 'artikel/index');
                exit;
            } else {
                $message = "Password yang Anda masukkan salah!";
            }
        } else {
            $message = "Username <strong>" . htmlspecialchars($username) . "</strong> tidak ditemukan!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .login-container { max-width: 400px; margin: 100px auto; padding: 30px; background: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border-radius: 12px; }
    </style>
</head>
<body>
<div class="login-container">
    <div class="text-center mb-4">
        <h3 class="fw-bold">Login User</h3>
    </div>

    <?php if ($message): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= $message ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="d-grid gap-2 mt-4">
            <button type="submit" class="btn btn-primary">Login Sekarang</button>
        </div>
    </form>
</div>
</body>
</html>
