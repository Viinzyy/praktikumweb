<?php
if (!isset($current_page)) {
    $current_page = 'dashboard';
}

$user_display_name = isset($_SESSION['nama_lengkap']) && !empty($_SESSION['nama_lengkap']) ? htmlspecialchars($_SESSION['nama_lengkap']) : 'Admin SIM RS';
$user_email = isset($_SESSION['email']) && !empty($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'admin@rs-elektro.id';
?>
  <!-- ==========================================
       START: Sidebar Component
       ========================================== -->
  <div class="sidebar-wrapper d-flex flex-column" id="sidebar">
    <!-- Brand Logo / Identity -->
    <a href="index.php" class="sidebar-brand">
      <i class="bi bi-hospital"></i>
      <span>SIM RS Spark</span>
    </a>

    <!-- Navigation Menu -->
    <div class="flex-grow-1 overflow-y-auto">
      <!-- Group: Menu Utama -->
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title">Menu Utama</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="index.php" class="sidebar-menu-link <?php echo ($current_page == 'dashboard') ? 'active' : ''; ?>" title="Dashboard">
              <i class="bi bi-grid-fill"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="index.php#data-alat" class="sidebar-menu-link <?php echo ($current_page == 'alat') ? 'active' : ''; ?>" title="Data Alat">
              <i class="bi bi-heart-pulse-fill"></i>
              <span>Data Alat Medis</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="#" class="sidebar-menu-link" data-bs-toggle="modal" data-bs-target="#modalTambahAlat" title="Tambah Alat">
              <i class="bi bi-plus-circle-fill"></i>
              <span>Tambah Alat</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Group: Akademik -->
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title">Informasi Praktikum</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="../index.php" class="sidebar-menu-link" title="Praktikum 4 Asli">
              <i class="bi bi-folder2-open"></i>
              <span>Praktikum 4 Lama</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="README.md" class="sidebar-menu-link" target="_blank" title="Dokumentasi Tugas">
              <i class="bi bi-journal-code"></i>
              <span>Dokumentasi README</span>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- AREA KIRI BAWAH: Profil Admin & Tombol Logout -->
    <div class="sidebar-bottom-area border-top pt-2" style="border-color: rgba(255,255,255,0.08) !important;">
      <!-- Sidebar Profile Card -->
      <div class="sidebar-profile mb-2">
        <img src="assets/images/avatar.png" alt="User Avatar" class="sidebar-profile-img"
          onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop'">
        <div class="sidebar-profile-info">
          <div class="sidebar-profile-name"><?php echo $user_display_name; ?></div>
          <div class="sidebar-profile-email"><?php echo $user_email; ?></div>
        </div>
      </div>

      <!-- Tombol Logout Kiri Bawah Tepat di Bawah Profil Admin -->
      <div class="px-3 pb-3">
        <a href="logout.php" onclick="return confirmLogout('logout.php');" class="btn-sidebar-logout d-flex align-items-center justify-content-center gap-2 text-decoration-none">
          <i class="bi bi-box-arrow-right"></i>
          <span>Keluar (Logout)</span>
        </a>
      </div>
    </div>
  </div>
  <!-- ==========================================
       END: Sidebar Component
       ========================================== -->

  <style>
    /* Styling Tombol Logout Kiri Bawah */
    .btn-sidebar-logout {
      background: rgba(239, 68, 68, 0.12);
      color: #ef4444;
      border: 1px solid rgba(239, 68, 68, 0.28);
      border-radius: 8px;
      padding: 0.55rem 0.85rem;
      font-size: 0.84rem;
      font-weight: 600;
      transition: all 0.2s ease-in-out;
      width: 100%;
    }
    .btn-sidebar-logout:hover {
      background: #ef4444;
      color: #ffffff !important;
      border-color: #ef4444;
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.35);
      transform: translateY(-1px);
    }
  </style>
