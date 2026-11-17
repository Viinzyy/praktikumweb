<?php
/**
 * Skrip Logout Pengguna - SIM RS
 * Menghapus seluruh sesi login dan mengarahkan kembali ke halaman login
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kosongkan seluruh variabel sesi
$_SESSION = array();

// Hapus cookie sesi jika ada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hancurkan sesi
session_destroy();

// Alihkan kembali ke halaman login dengan notifikasi
header("Location: login.php?msg=logout");
exit;
?>
