<?php
// Memulai session agar sistem tahu session mana yang akan dihapus
session_start();

// Menghapus semua variabel session
$_SESSION = array();

// Jika ingin menghapus session secara total (termasuk cookie session di browser)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Menghancurkan session
session_destroy();

// Mengalihkan pengguna kembali ke halaman login
header('Location: ../user/login');
exit;
?>
