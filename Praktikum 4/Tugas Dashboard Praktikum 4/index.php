<?php
/**
 * Dashboard SIM RS - Data Alat Elektromedis
 * Tugas Dashboard Praktikum 4
 * Template: Spark Admin Bootstrap 5
 */

include_once("config.php");
include_once("includes/auth_check.php");

$page_title = "Dashboard Data Alat Elektromedis";
$current_page = "dashboard";

// Inisialisasi variabel statistik
$total_alat = 0;
$total_merek = 0;
$total_lokasi = 0;
$alat_list = [];

if ($db_connected) {
    // Hitung total alat
    $q_total = mysqli_query($mysqli, "SELECT COUNT(*) as total FROM alat");
    if ($q_total && $row = mysqli_fetch_assoc($q_total)) {
        $total_alat = $row['total'];
    }

    // Hitung jumlah merek unik
    $q_merek = mysqli_query($mysqli, "SELECT COUNT(DISTINCT merek) as total_merek FROM alat");
    if ($q_merek && $row = mysqli_fetch_assoc($q_merek)) {
        $total_merek = $row['total_merek'];
    }

    // Hitung jumlah lokasi unik
    $q_lokasi = mysqli_query($mysqli, "SELECT COUNT(DISTINCT lokasi) as total_lokasi FROM alat");
    if ($q_lokasi && $row = mysqli_fetch_assoc($q_lokasi)) {
        $total_lokasi = $row['total_lokasi'];
    }

    // Ambil semua data alat urut dari yang terbaru
    $result = mysqli_query($mysqli, "SELECT * FROM alat ORDER BY id DESC");
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $alat_list[] = $row;
        }
    }
}

// Cek flash message
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';

include_once("includes/header.php");
include_once("includes/sidebar.php");
?>

  <!-- START: Main Wrapper -->
  <div class="main-wrapper">
    <?php include_once("includes/navbar.php"); ?>

    <!-- START: Page Header Banner -->
    <div class="page-header">
      <div>
        <h1 class="page-title">Dashboard SIM RS</h1>
        <p class="page-subtitle">Sistem Informasi Manajemen & Inventaris Alat Elektromedis Rumah Sakit</p>
      </div>
      <div class="d-flex align-items-center gap-2">
        <!-- Tombol Pemicu Modal Pop-Up Tambah Alat -->
        <button type="button" class="btn-custom btn-custom-primary" data-bs-toggle="modal" data-bs-target="#modalTambahAlat">
          <i class="bi bi-plus-lg"></i> Tambah Alat Baru
        </button>
      </div>
    </div>
    <!-- END: Page Header Banner -->

    <!-- ALERT NOTIFICATIONS JIKA DATABASE GAGAL -->
    <?php if (!$db_connected): ?>
      <div class="alert-custom alert-custom-danger mb-4">
        <i class="bi bi-exclamation-triangle-fill alert-custom-icon"></i>
        <div class="alert-custom-content">
          <strong>Koneksi Database Terputus:</strong> Tidak dapat terhubung ke database <code>simrs</code> di MySQL localhost.
          <br>Pastikan Apache & MySQL di <strong>XAMPP Control Panel</strong> sudah dijalankan (Start), dan database <code>simrs</code> sudah diimport dari file <code>database.sql</code>.
        </div>
      </div>
    <?php endif; ?>

    <!-- START: Stat Cards Grid -->
    <div class="row g-4 mb-4">
      <!-- Card 1: Green Theme Alert Card -->
      <div class="col-12 col-md-6 col-xl-3">
        <div class="card alert-green-card h-100">
          <div class="position-relative z-index-2">
            <span class="alert-green-badge">Sistem Aktif</span>
            <div class="alert-green-date"><?php echo date('d M Y'); ?></div>
            <div class="alert-green-text">Modul Inventaris Elektromedis Praktikum 4</div>
          </div>
          <a href="#data-alat" class="alert-green-link z-index-2">
            <span>Lihat Tabel Alat</span>
            <i class="bi bi-arrow-right"></i>
          </a>
          <!-- Geometric background shape -->
          <svg class="alert-green-bg-shape" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g transform="translate(50,50)">
              <rect x="-6" y="-45" width="12" height="90" rx="6" ry="6" fill="#B4F105" />
              <rect x="-6" y="-45" width="12" height="90" rx="6" ry="6" fill="#B4F105" transform="rotate(60)" />
              <rect x="-6" y="-45" width="12" height="90" rx="6" ry="6" fill="#B4F105" transform="rotate(120)" />
            </g>
          </svg>
        </div>
      </div>

      <!-- Card 2: Total Alat -->
      <div class="col-12 col-md-6 col-xl-3">
        <div class="card card-stat h-100 d-flex flex-column justify-content-between p-3">
          <div>
            <div class="card-header border-0 pb-0 px-0 d-flex justify-content-between align-items-center">
              <span class="stat-label">Total Alat Medis</span>
              <div class="stat-icon-wrapper bg-primary text-white">
                <i class="bi bi-heart-pulse"></i>
              </div>
            </div>
            <div class="stat-value mt-2"><?php echo $total_alat; ?> <span class="fs-6 fw-normal text-muted">Unit</span></div>
            <div class="trend-badge trend-up mt-2">
              <i class="bi bi-check-circle"></i>
              <span>Terdata di SIM RS</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 3: Total Merek -->
      <div class="col-12 col-md-6 col-xl-3">
        <div class="card card-stat h-100 d-flex flex-column justify-content-between p-3">
          <div>
            <div class="card-header border-0 pb-0 px-0 d-flex justify-content-between align-items-center">
              <span class="stat-label">Merek Terdaftar</span>
              <div class="stat-icon-wrapper bg-success text-white">
                <i class="bi bi-tag-fill"></i>
              </div>
            </div>
            <div class="stat-value mt-2"><?php echo $total_merek; ?> <span class="fs-6 fw-normal text-muted">Vendor</span></div>
            <div class="trend-badge trend-up mt-2">
              <i class="bi bi-shield-check"></i>
              <span>Vendor Terakreditasi</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 4: Total Lokasi / Ruangan -->
      <div class="col-12 col-md-6 col-xl-3">
        <div class="card card-stat h-100 d-flex flex-column justify-content-between p-3">
          <div>
            <div class="card-header border-0 pb-0 px-0 d-flex justify-content-between align-items-center">
              <span class="stat-label">Ruangan Tersebar</span>
              <div class="stat-icon-wrapper bg-warning text-dark">
                <i class="bi bi-geo-alt-fill"></i>
              </div>
            </div>
            <div class="stat-value mt-2"><?php echo $total_lokasi; ?> <span class="fs-6 fw-normal text-muted">Ruangan</span></div>
            <div class="trend-badge trend-up mt-2">
              <i class="bi bi-hospital"></i>
              <span>Instalasi RS</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END: Stat Cards Grid -->

    <!-- START: Table Card Container -->
    <div class="table-card-custom mb-5" id="data-alat">
      <!-- Header Controls -->
      <div class="table-header-control d-flex flex-wrap gap-3 justify-content-between align-items-center">
        <!-- Search bar -->
        <div class="table-search-box">
          <i class="bi bi-search table-search-icon"></i>
          <input type="text" class="table-search-input" id="tableSearchInput" placeholder="Cari alat, tahun, merek, atau lokasi...">
        </div>
        <!-- Actions -->
        <div class="d-flex align-items-center gap-2">
          <!-- Tombol Pemicu Modal Pop-Up Tambah Alat -->
          <button type="button" class="btn-custom btn-custom-primary" data-bs-toggle="modal" data-bs-target="#modalTambahAlat">
            <i class="bi bi-plus-circle"></i> Tambah Alat
          </button>
        </div>
      </div>

      <!-- Responsive Table -->
      <div class="table-responsive">
        <table class="table-custom align-middle" id="tableAlat">
          <thead>
            <tr>
              <th style="width: 60px;">No</th>
              <th>Nama Alat Elektromedis</th>
              <th style="width: 120px;">Tahun</th>
              <th>Merek / Pabrikan</th>
              <th>Lokasi / Ruangan</th>
              <th class="text-center" style="width: 130px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($alat_list)): ?>
              <tr>
                <td colspan="6" class="text-center py-5">
                  <div class="empty-state text-muted">
                    <i class="bi bi-inbox fs-1 d-block mb-2 text-muted-green"></i>
                    <h5>Belum ada data alat</h5>
                    <p class="mb-3">Silakan tambahkan data alat pertama Anda melalui tombol di bawah.</p>
                    <button type="button" class="btn-custom btn-custom-primary" data-bs-toggle="modal" data-bs-target="#modalTambahAlat">
                      Tambah Alat Baru
                    </button>
                  </div>
                </td>
              </tr>
            <?php else: ?>
              <?php $no = 1; foreach ($alat_list as $alat): ?>
                <tr class="alat-row">
                  <td class="fw-semibold text-muted"><?php echo $no++; ?></td>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <div class="p-2 rounded bg-light text-success">
                        <i class="bi bi-heart-pulse-fill"></i>
                      </div>
                      <div>
                        <div class="fw-bold text-dark"><?php echo htmlspecialchars($alat['nama_alat']); ?></div>
                        <small class="text-muted">ID: #ALT-<?php echo str_pad($alat['id'], 3, '0', STR_PAD_LEFT); ?></small>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="badge-year"><?php echo htmlspecialchars($alat['tahun']); ?></span>
                  </td>
                  <td>
                    <span class="badge-brand">
                      <i class="bi bi-tag-fill text-muted me-1"></i><?php echo htmlspecialchars($alat['merek']); ?>
                    </span>
                  </td>
                  <td>
                    <span class="badge-room">
                      <i class="bi bi-geo-alt"></i><?php echo htmlspecialchars($alat['lokasi']); ?>
                    </span>
                  </td>
                  <td>
                    <div class="d-flex justify-content-center gap-1">
                      <a href="edit.php?id=<?php echo $alat['id']; ?>" class="table-btn-action" title="Edit Alat">
                        <i class="bi bi-pencil-square"></i>
                      </a>
                      <!-- Tombol Hapus dengan Notifikasi SweetAlert2 Ramah -->
                      <a href="javascript:void(0);" 
                         onclick="return confirmDelete('delete.php?id=<?php echo $alat['id']; ?>', '<?php echo htmlspecialchars(addslashes($alat['nama_alat'])); ?>');"
                         class="table-btn-action delete" title="Hapus Alat">
                        <i class="bi bi-trash"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
            <tr id="noFilterResult" style="display: none;">
              <td colspan="6" class="text-center py-4 text-muted">
                <i class="bi bi-search fs-3 d-block mb-2"></i>
                Tidak ada data alat yang cocok dengan pencarian Anda.
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Table Footer / Count summary -->
      <div class="p-3 border-top d-flex justify-content-between align-items-center text-muted small">
        <div>Menampilkan <strong><?php echo count($alat_list); ?></strong> data alat terdaftar</div>
        <div>Sistem Informasi Manajemen Rumah Sakit &bull; Spark Admin v1.0.0</div>
      </div>
    </div>
    <!-- END: Table Card Container -->

    <!-- ==========================================
         START: Jendela Pop-up Modal Tambah Alat
         ========================================== -->
    <div class="modal fade" id="modalTambahAlat" tabindex="-1" aria-labelledby="modalTambahAlatLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-lg">
          <div class="modal-header bg-light border-0 py-3 px-4">
            <div class="d-flex align-items-center gap-2">
              <div class="stat-icon-wrapper bg-success text-white" style="width: 38px; height: 38px; font-size: 1.2rem; border-radius: 10px;">
                <i class="bi bi-plus-lg"></i>
              </div>
              <div>
                <h5 class="modal-title fw-bold text-dark mb-0" id="modalTambahAlatLabel">Tambah Alat Elektromedis Baru</h5>
                <small class="text-muted">Lengkapi spesifikasi teknis dan ruangan penempatan alat</small>
              </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>

          <form action="add.php" method="POST" id="formModalTambah">
            <div class="modal-body p-4">
              <!-- Nama Alat -->
              <div class="mb-3">
                <label for="modal_nama_alat" class="form-label-custom fw-semibold">Nama Alat Elektromedis <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0"><i class="bi bi-heart-pulse"></i></span>
                  <input type="text" class="form-control form-control-custom border-start-0" id="modal_nama_alat" name="nama_alat"
                         placeholder="Contoh: Defibrillator HeartStart XL+, USG 4D Mindray" required autofocus>
                </div>
                <small class="text-muted">Masukkan tipe atau model lengkap alat elektromedis.</small>
              </div>

              <div class="row g-3 mb-3">
                <!-- Tahun Pengadaan -->
                <div class="col-12 col-md-6">
                  <label for="modal_tahun" class="form-label-custom fw-semibold">Tahun Pengadaan <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-calendar3"></i></span>
                    <input type="text" class="form-control form-control-custom border-start-0" id="modal_tahun" name="tahun"
                           placeholder="Contoh: <?php echo date('Y'); ?>" maxlength="4" required value="<?php echo date('Y'); ?>">
                  </div>
                  <small class="text-muted">Tahun unit diterima / dibeli.</small>
                </div>

                <!-- Merek / Pabrikan -->
                <div class="col-12 col-md-6">
                  <label for="modal_merek" class="form-label-custom fw-semibold">Merek / Pabrikan <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-tag"></i></span>
                    <input type="text" list="modalBrandList" class="form-control form-control-custom border-start-0" id="modal_merek" name="merek"
                           placeholder="Contoh: Philips, Mindray, GE" required>
                  </div>
                  <datalist id="modalBrandList">
                    <option value="Philips">
                    <option value="GE Healthcare">
                    <option value="Mindray">
                    <option value="Siemens Healthineers">
                    <option value="Draeger">
                    <option value="Getinge">
                    <option value="Medela">
                    <option value="Nihon Kohden">
                  </datalist>
                  <small class="text-muted">Pilih atau ketik nama vendor/merek.</small>
                </div>
              </div>

              <!-- Lokasi Penempatan -->
              <div class="mb-2">
                <label for="modal_lokasi" class="form-label-custom fw-semibold">Lokasi Penempatan / Ruangan <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0"><i class="bi bi-geo-alt"></i></span>
                  <input type="text" list="modalRoomList" class="form-control form-control-custom border-start-0" id="modal_lokasi" name="lokasi"
                         placeholder="Contoh: Ruang ICU, IGD, Instalasi Radiologi" required>
                </div>
                <datalist id="modalRoomList">
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
                <small class="text-muted">Ruangan atau unit instalasi rumah sakit.</small>
              </div>
            </div>

            <div class="modal-footer bg-light border-0 py-3 px-4 d-flex justify-content-end gap-2">
              <button type="button" class="btn-custom btn-custom-outline-secondary" data-bs-dismiss="modal">
                <i class="bi bi-x-lg"></i> Batal
              </button>
              <button type="submit" name="Submit" class="btn-custom btn-custom-primary">
                <i class="bi bi-check-circle-fill"></i> Simpan Alat Baru
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- ==========================================
         END: Jendela Pop-up Modal Tambah Alat
         ========================================== -->

    <?php include_once("includes/footer.php"); ?>
  </div>
  <!-- END: Main Wrapper -->

  <!-- SweetAlert2 Trigger untuk Flash Messages -->
  <?php if (!empty($msg)): ?>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      <?php if ($msg === 'added'): ?>
        Toast.fire({
          icon: 'success',
          title: 'Berhasil menambahkan data alat baru!'
        });
      <?php elseif ($msg === 'updated'): ?>
        Toast.fire({
          icon: 'success',
          title: 'Data alat berhasil diperbarui!'
        });
      <?php elseif ($msg === 'deleted'): ?>
        Toast.fire({
          icon: 'info',
          title: 'Satu data alat berhasil dihapus dari sistem.'
        });
      <?php endif; ?>
    });
  </script>
  <?php endif; ?>
