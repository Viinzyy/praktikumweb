<?php
/**
 * Middleware Proteksi Autentikasi Pengguna
 * Memastikan pengguna sudah login sebelum dapat mengakses halaman sistem
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah session user_id sudah ada
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: login.php?msg=unauthorized");
    exit;
}
