<?php
/**
 * Edit Data Alat Elektromedis
 * Tugas Dashboard Praktikum 4
 * Template: Spark Admin Bootstrap 5
 */

include_once("config.php");

$page_title = "Edit Data Alat Elektromedis";
$current_page = "alat";
$error_msg = "";

// Cek jika proses update disubmit melalui method POST
if (isset($_POST['update'])) {
    $id        = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $nama_alat = isset($_POST['nama_alat']) ? trim($_POST['nama_alat']) : '';
    $tahun     = isset($_POST['tahun']) ? trim($_POST['tahun']) : '';
    $merek     = isset($_POST['merek']) ? trim($_POST['merek']) : '';
    $lokasi    = isset($_POST['lokasi']) ? trim($_POST['lokasi']) : '';

    if (empty($nama_alat) || empty($tahun) || empty($merek) || empty($lokasi)) {
        $error_msg = "Semua field wajib diisi!";
    } elseif (!$db_connected) {
        $error_msg = "Database belum terhubung.";
    } else {
        $safe_nama   = mysqli_real_escape_string($mysqli, $nama_alat);
        $safe_tahun  = mysqli_real_escape_string($mysqli, $tahun);
        $safe_merek  = mysqli_real_escape_string($mysqli, $merek);
        $safe_lokasi = mysqli_real_escape_string($mysqli, $lokasi);

        $update_query = "UPDATE alat SET nama_alat='$safe_nama', tahun='$safe_tahun', merek='$safe_merek', lokasi='$safe_lokasi' WHERE id=$id";
        $update = mysqli_query($mysqli, $update_query);

        if ($update) {
            header("Location: index.php?msg=updated");
            exit;
        } else {
            $error_msg = "Gagal memperbarui data: " . mysqli_error($mysqli);
        }
    }
}

// Ambil data alat berdasarkan ID dari parameter URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$nama_alat = "";
$tahun = "";
$merek = "";
$lokasi = "";

if ($db_connected) {
    $result = mysqli_query($mysqli, "SELECT * FROM alat WHERE id=$id");
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nama_alat = $row['nama_alat'];
        $tahun     = $row['tahun'];
        $merek     = $row['merek'];
        $lokasi    = $row['lokasi'];
    } else {
        header("Location: index.php");
        exit;
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
        <h1 class="page-title">Edit Data Alat Medis</h1>
        <p class="page-subtitle">Perbarui data spesifikasi dan lokasi alat elektromedis #ALT-<?php echo str_pad($id, 3, '0', STR_PAD_LEFT); ?></p>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-muted-green">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="index.php#data-alat" class="text-decoration-none text-muted-green">Data Alat</a></li>
          <li class="breadcrumb-item active text-main" aria-current="page">Edit Alat</li>
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
            <div class="stat-icon-wrapper bg-primary text-white">
              <i class="bi bi-pencil-square"></i>
            </div>
            <div>
              <h4 class="mb-1 text-dark">Edit Informasi Alat</h4>
              <p class="text-muted mb-0 small">Ubah data di bawah ini lalu klik tombol Simpan Perubahan.</p>
            </div>
          </div>

          <form action="edit.php?id=<?php echo $id; ?>" method="post" name="formEdit">
            <!-- Hidden ID Input -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <!-- Nama Alat -->
            <div class="mb-4">
              <label for="nama_alat" class="form-label-custom">Nama Alat Elektromedis <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-heart-pulse"></i></span>
                <input type="text" class="form-control form-control-custom border-start-0" id="nama_alat" name="nama_alat"
                       required value="<?php echo htmlspecialchars($nama_alat); ?>">
              </div>
            </div>

            <div class="row g-3 mb-4">
              <!-- Tahun Pengadaan -->
              <div class="col-12 col-md-6">
                <label for="tahun" class="form-label-custom">Tahun Pengadaan <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0"><i class="bi bi-calendar3"></i></span>
                  <input type="text" class="form-control form-control-custom border-start-0" id="tahun" name="tahun"
                         maxlength="4" required value="<?php echo htmlspecialchars($tahun); ?>">
                </div>
              </div>

              <!-- Merek / Pabrikan -->
              <div class="col-12 col-md-6">
                <label for="merek" class="form-label-custom">Merek / Pabrikan <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0"><i class="bi bi-tag"></i></span>
                  <input type="text" list="brandList" class="form-control form-control-custom border-start-0" id="merek" name="merek"
                         required value="<?php echo htmlspecialchars($merek); ?>">
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
              </div>
            </div>

            <!-- Lokasi / Ruangan -->
            <div class="mb-4">
              <label for="lokasi" class="form-label-custom">Lokasi Penempatan / Ruangan <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-geo-alt"></i></span>
                <input type="text" list="roomList" class="form-control form-control-custom border-start-0" id="lokasi" name="lokasi"
                       required value="<?php echo htmlspecialchars($lokasi); ?>">
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
            </div>

            <!-- Action Buttons -->
            <div class="d-flex flex-wrap align-items-center gap-3 pt-3 border-top">
              <button type="submit" name="update" class="btn-custom btn-custom-primary">
                <i class="bi bi-check2-circle"></i> Simpan Perubahan
              </button>
              <a href="index.php" class="btn-custom btn-custom-outline-secondary">
                <i class="bi bi-arrow-left"></i> Batal
              </a>
            </div>
          </form>
        </div>

      </div>
    </div>

    <?php include_once("includes/footer.php"); ?>
  </div>
  <!-- END: Main Wrapper -->
