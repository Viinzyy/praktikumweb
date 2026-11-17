<?php
/**
 * Hapus Data Alat Elektromedis
 * Tugas Dashboard Praktikum 4
 * Template: Spark Admin Bootstrap 5
 */

include_once("config.php");

// Ambil id dari parameter URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0 && $db_connected) {
    // Jalankan query penghapusan data
    $delete = mysqli_query($mysqli, "DELETE FROM alat WHERE id=$id");
    
    if ($delete) {
        header("Location: index.php?msg=deleted");
        exit;
    }
}

// Jika gagal atau ID tidak valid, tetap arahkan ke dashboard
header("Location: index.php");
exit;
?>
