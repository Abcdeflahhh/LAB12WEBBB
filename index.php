<?php
/**
 * FRONT CONTROLLER - index.php
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Definisi Path Absolut
define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR);
define('CLASS_PATH', ROOT_PATH . 'class' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . 'Module' . DIRECTORY_SEPARATOR); 
define('TEMPLATE_PATH', ROOT_PATH . 'template' . DIRECTORY_SEPARATOR);
define('CONFIG_PATH', ROOT_PATH . 'config.php');

// 2. Load Konfigurasi & Class
if (file_exists(CONFIG_PATH)) {
    require_once CONFIG_PATH;
} else {
    die("Fatal Error: File config.php tidak ditemukan.");
}

// Load Database Class
if (file_exists(CLASS_PATH . "Database.php")) {
    require_once CLASS_PATH . "Database.php";
    $db = new Database(); 
} else {
    die("Fatal Error: Class Database tidak ditemukan di " . CLASS_PATH);
}

// --- TAMBAHKAN BAGIAN INI: Load Form Class ---
if (file_exists(CLASS_PATH . "Form.php")) {
    require_once CLASS_PATH . "Form.php";
} else {
    // Opsional: Jika Form tidak selalu dipakai di semua halaman, 
    // pastikan tidak die() di sini, tapi di kasus Anda, Home membutuhkannya.
    die("Fatal Error: Class Form tidak ditemukan di " . CLASS_PATH . "Form.php");
}
// ----------------------------------------------

// 3. Routing Logic
$request_uri = $_SERVER['REQUEST_URI'];
$script_name = dirname($_SERVER['SCRIPT_NAME']);
$path = str_replace($script_name, '', $request_uri);
$path = trim(parse_url($path, PHP_URL_PATH), '/');

$segments = explode('/', $path);

$mod  = !empty($segments[0]) ? preg_replace('/[^a-zA-Z0-9_-]/', '', $segments[0]) : 'home';
$page = !empty($segments[1]) ? preg_replace('/[^a-zA-Z0-9_-]/', '', $segments[1]) : 'index';

// 4. Proteksi Halaman (Access Control List)
$public_modules = ['home', 'user']; 
if (!in_array($mod, $public_modules)) {
    if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
        header('Location: ' . BASE_URL . 'user/login');
        exit();
    }
}

// 5. Render Halaman
$file = MODULE_PATH . $mod . DIRECTORY_SEPARATOR . $page . '.php';

if (file_exists($file)) {
    $is_login_page = ($mod === 'user' && $page === 'login');

    if ($is_login_page) {
        include $file; 
    } else {
        // Variable $db dan $form akan otomatis tersedia di dalam file yang di-include
        if (file_exists(TEMPLATE_PATH . "header.php")) include TEMPLATE_PATH . "header.php";
        include $file;
        if (file_exists(TEMPLATE_PATH . "footer.php")) include TEMPLATE_PATH . "footer.php";
    }
} else {
    http_response_code(404);
    echo "<h1>404 Not Found</h1><p>File module tidak ditemukan.</p>";
}
