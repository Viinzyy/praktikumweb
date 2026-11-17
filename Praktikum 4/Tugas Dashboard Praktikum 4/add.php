<?php
/**
 * Tambah Data Alat Elektromedis
 * Tugas Dashboard Praktikum 4
 * Template: Spark Admin Bootstrap 5
 */

include_once("config.php");
include_once("includes/auth_check.php");

$page_title = "Tambah Alat Elektromedis";
$current_page = "add";
$error_msg = "";

// Proses form tambah alat saat tombol Submit ditekan
if (isset($_POST['Submit'])) {
    $nama_alat = isset($_POST['nama_alat']) ? trim($_POST['nama_alat']) : '';
    $tahun     = isset($_POST['tahun']) ? trim($_POST['tahun']) : '';
    $merek     = isset($_POST['merek']) ? trim($_POST['merek']) : '';
    $lokasi    = isset($_POST['lokasi']) ? trim($_POST['lokasi']) : '';

    if (empty($nama_alat) || empty($tahun) || empty($merek) || empty($lokasi)) {
        $error_msg = "Semua field wajib diisi!";
    } elseif (!$db_connected) {
        $error_msg = "Database belum terhubung. Periksa konfigurasi MySQL Anda.";
    } else {
        // Bersihkan input agar aman
        $safe_nama   = mysqli_real_escape_string($mysqli, $nama_alat);
        $safe_tahun  = mysqli_real_escape_string($mysqli, $tahun);
        $safe_merek  = mysqli_real_escape_string($mysqli, $merek);
        $safe_lokasi = mysqli_real_escape_string($mysqli, $lokasi);

        // Eksekusi insert query ke tabel alat
        $insert = mysqli_query($mysqli, "INSERT INTO alat (nama_alat, tahun, merek, lokasi) VALUES ('$safe_nama', '$safe_tahun', '$safe_merek', '$safe_lokasi')");

        if ($insert) {
            header("Location: index.php?msg=added");
            exit;
        } else {
            $error_msg = "Gagal menyimpan data: " . mysqli_error($mysqli);
        }
    }
}

include_once("includes/header.php");
include_once("includes/sidebar.php");
?>

  <!-- START: Main Wrapper -->
  <div class="main-wrapper">
    <?php include_once("includes/navbar.php"); ?>

    <!-- START: Page Header Banner -->
    <div class="page-header">
      <div>
        <h1 class="page-title">Tambah Alat Elektromedis</h1>
        <p class="page-subtitle">Registrasi inventaris alat medis baru ke dalam database SIM RS</p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-muted-green">Dashboard</a></li>
          <li class="breadcrumb-item active text-main" aria-current="page">Tambah Alat</li>
        </ol>
      </nav>
    </div>
    <!-- END: Page Header Banner -->

    <!-- Form Container -->
    <div class="row justify-content-center">
      <div class="col-12 col-xl-8">
        
        <?php if (!empty($error_msg)): ?>
          <div class="alert-custom alert-custom-danger mb-4">
            <i class="bi bi-exclamation-triangle-fill alert-custom-icon"></i>
            <div class="alert-custom-content">
              <strong>Peringatan:</strong> <?php echo htmlspecialchars($error_msg); ?>
            </div>
          </div>
        <?php endif; ?>

        <div class="card border-light shadow-sm p-4 p-md-5 mb-5">
          <div class="d-flex align-items-center gap-3 mb-4 border-bottom pb-3">
            <div class="stat-icon-wrapper bg-success text-white">
              <i class="bi bi-plus-circle-fill"></i>
            </div>
            <div>
              <h4 class="mb-1 text-dark">Formulir Data Alat Baru</h4>
              <p class="text-muted mb-0 small">Pastikan data spesifikasi teknis dan lokasi alat sesuai dengan fisik di lapangan.</p>
            </div>
          </div>

          <form action="add.php" method="post" name="formAdd">
            <!-- Nama Alat -->
            <div class="mb-4">
              <label for="nama_alat" class="form-label-custom">Nama Alat Elektromedis <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-heart-pulse"></i></span>
                <input type="text" class="form-control form-control-custom border-start-0" id="nama_alat" name="nama_alat"
                       placeholder="Contoh: Patient Monitor Efficia CM12, Defibrillator XL+" required autofocus
                       value="<?php echo isset($_POST['nama_alat']) ? htmlspecialchars($_POST['nama_alat']) : ''; ?>">
              </div>
              <small class="text-muted">Masukkan nama lengkap tipe atau model alat elektromedis.</small>
            </div>

            <div class="row g-3 mb-4">
              <!-- Tahun Pengadaan -->
              <div class="col-12 col-md-6">
                <label for="tahun" class="form-label-custom">Tahun Pengadaan <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0"><i class="bi bi-calendar3"></i></span>
                  <input type="text" class="form-control form-control-custom border-start-0" id="tahun" name="tahun"
                         placeholder="Contoh: 2024" maxlength="4" required
                         value="<?php echo isset($_POST['tahun']) ? htmlspecialchars($_POST['tahun']) : date('Y'); ?>">
                </div>
                <small class="text-muted">Tahun unit alat diterima / dibeli.</small>
              </div>

              <!-- Merek / Pabrikan -->
              <div class="col-12 col-md-6">
                <label for="merek" class="form-label-custom">Merek / Pabrikan <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0"><i class="bi bi-tag"></i></span>
                  <input type="text" list="brandList" class="form-control form-control-custom border-start-0" id="merek" name="merek"
                         placeholder="Contoh: Philips, GE Healthcare, Mindray" required
                         value="<?php echo isset($_POST['merek']) ? htmlspecialchars($_POST['merek']) : ''; ?>">
                </div>
                <datalist id="brandList">
                  <option value="Philips">
                  <option value="GE Healthcare">
                  <option value="Mindray">
                  <option value="Siemens Healthineers">
                  <option value="Dräger">
                  <option value="Getinge">
                  <option value="Medela">
                  <option value="Nihon Kohden">
                </datalist>
                <small class="text-muted">Pilih atau ketik merek pabrikan.</small>
              </div>
            </div>

            <!-- Lokasi / Ruangan -->
            <div class="mb-4">
              <label for="lokasi" class="form-label-custom">Lokasi Penempatan / Ruangan <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-geo-alt"></i></span>
                <input type="text" list="roomList" class="form-control form-control-custom border-start-0" id="lokasi" name="lokasi"
                       placeholder="Contoh: Ruang ICU, IGD, Instalasi Radiologi, Kamar Bedah Sentral (OK)" required
                       value="<?php echo isset($_POST['lokasi']) ? htmlspecialchars($_POST['lokasi']) : ''; ?>">
              </div>
              <datalist id="roomList">
                <option value="Ruang ICU">
                <option value="Instalasi Gawat Darurat (IGD)">
                <option value="Kamar Bedah Sentral (OK)">
                <option value="Instalasi Radiologi">
                <option value="Poli Jantung">
                <option value="Poli Kandungan">
                <option value="Ruang Rawat Inap Melati">
                <option value="Ruang PICU/NICU">
                <option value="Laboratorium Klinik">
              </datalist>
              <small class="text-muted">Ruangan atau unit instalasi tempat alat ini dioperasikan.</small>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex flex-wrap align-items-center gap-3 pt-3 border-top">
              <button type="submit" name="Submit" class="btn-custom btn-custom-primary">
                <i class="bi bi-check-circle-fill"></i> Simpan Data Alat
              </button>
              <a href="index.php" class="btn-custom btn-custom-outline-secondary">
                <i class="bi bi-arrow-left"></i> Batal / Kembali
              </a>
            </div>
          </form>
        </div>

      </div>
    </div>

    <?php include_once("includes/footer.php"); ?>
  </div>
  <!-- END: Main Wrapper -->
