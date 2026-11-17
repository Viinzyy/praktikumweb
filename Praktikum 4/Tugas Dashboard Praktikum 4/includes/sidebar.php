<?php
if (!isset($current_page)) {
    $current_page = 'dashboard';
}
?>
  <!-- ==========================================
       START: Sidebar Component
       ========================================== -->
  <div class="sidebar-wrapper" id="sidebar">
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
            <a href="add.php" class="sidebar-menu-link <?php echo ($current_page == 'add') ? 'active' : ''; ?>" title="Tambah Alat">
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

    <!-- Sidebar Profile Card -->
    <div class="sidebar-profile">
      <img src="assets/images/avatar.png" alt="Admin Elektromedis" class="sidebar-profile-img"
        onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop'">
      <div class="sidebar-profile-info">
        <div class="sidebar-profile-name">Admin SIM RS</div>
        <div class="sidebar-profile-email">admin@rs-elektro.id</div>
      </div>
    </div>
  </div>
  <!-- ==========================================
       END: Sidebar Component
       ========================================== -->
