<?php
/**
 * File: config.php
 * Konfigurasi Global Aplikasi - Anti-Redefine Version
 */

// 1. Pengaturan URL Dasar
if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://localhost/lab11_php_oop/');
}

// 2. Detail Database (Cek apakah sudah didefinisikan sebelumnya)
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_USER')) define('DB_USER', 'root');
if (!defined('DB_PASS')) define('DB_PASS', '');
if (!defined('DB_NAME')) define('DB_NAME', 'lab11_php_oop');

// 3. Variabel $config (Array)
// Tetap didefinisikan agar class Database bisa mengambil nilainya
$config = [
    'host'     => DB_HOST,
    'username' => DB_USER,
    'password' => DB_PASS,
    'db_name'  => DB_NAME
];
