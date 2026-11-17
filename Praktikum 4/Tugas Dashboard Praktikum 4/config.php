<?php
/**
 * Konfigurasi Koneksi Database SIM RS
 * Praktikum 4 - Pemrograman Web
 */

$databaseHost     = 'localhost';
$databaseName     = 'simrs';
$databaseUsername = 'root';
$databasePassword = '';

$db_connected = false;
$db_error = '';
$mysqli = null;

// Nonaktifkan throw exception default PHP 8+ agar penanganan error tidak fatal crash
mysqli_report(MYSQLI_REPORT_OFF);

try {
    // Mencoba koneksi ke MySQL server
    $mysqli = @mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

    if (!$mysqli) {
        $db_connected = false;
        $db_error = mysqli_connect_error();
    } else {
        $db_connected = true;
        $db_error = '';
        mysqli_set_charset($mysqli, "utf8mb4");
    }
} catch (Throwable $e) {
    $db_connected = false;
    $db_error = $e->getMessage();
}
