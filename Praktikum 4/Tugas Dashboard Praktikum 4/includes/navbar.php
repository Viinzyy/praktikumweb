  <!-- ==========================================
       START: Top Navbar Component
       ========================================== -->
  <header class="navbar-custom">
    <div class="navbar-left">
      <!-- Desktop sidebar toggle -->
      <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
        id="desktop-sidebar-toggle" aria-label="Minimize Sidebar">
        <i class="bi bi-chevron-bar-left"></i>
      </button>
      <!-- Mobile sidebar toggle -->
      <button class="sidebar-toggle-btn me-2" id="sidebar-toggle" aria-label="Toggle Navigation">
        <i class="bi bi-list"></i>
      </button>

      <!-- Quick Actions Dropdown -->
      <div class="dropdown ms-2">
        <a href="add.php" class="btn-quick-action text-decoration-none">
          <i class="bi bi-plus-lg"></i>
          <span>Tambah Alat</span>
        </a>
      </div>
    </div>

    <!-- Mid navbar: search pill -->
    <div class="navbar-search-wrapper">
      <input type="text" class="navbar-search-input" id="navbarLiveSearch" placeholder="Cari nama alat, merek, atau lokasi...">
      <button class="navbar-search-btn" aria-label="Search" type="button" onclick="focusSearch()">
        <i class="bi bi-search"></i>
      </button>
    </div>

    <!-- Right actions -->
    <div class="navbar-actions">
      <!-- Fullscreen Toggle -->
      <button class="navbar-action-btn me-1" aria-label="Toggle Fullscreen" id="btn-fullscreen">
        <i class="bi bi-arrows-fullscreen"></i>
      </button>

      <!-- Notifications -->
      <div class="dropdown">
        <button class="navbar-action-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
          aria-expanded="false" id="btn-notifications" data-bs-auto-close="outside">
          <i class="bi bi-bell"></i>
          <span class="navbar-action-badge"></span>
        </button>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-notification p-0"
          aria-labelledby="btn-notifications">
          <div class="notification-header">
            <h6 class="notification-title">Notifikasi Sistem</h6>
            <button class="btn-clear-all" type="button">Tandai dibaca</button>
          </div>
          <div class="notification-list">
            <a href="#" class="notification-item">
              <div class="notification-icon bg-success text-white">
                <i class="bi bi-check-circle"></i>
              </div>
              <div class="notification-content">
                <p class="notification-text">Database <strong>SIM RS</strong> terhubung dan aktif.</p>
                <span class="notification-time">Sekarang</span>
              </div>
            </a>
            <a href="#" class="notification-item">
              <div class="notification-icon bg-primary text-white">
                <i class="bi bi-shield-check"></i>
              </div>
              <div class="notification-content">
                <p class="notification-text">Spark Admin v1.0.0 berhasil dimuat.</p>
                <span class="notification-time">1 menit lalu</span>
              </div>
            </a>
          </div>
        </div>
      </div>

      <!-- Profile Dropdown -->
      <div class="dropdown ms-2">
        <button class="navbar-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
          aria-expanded="false" id="profile-dropdown">
          <img src="assets/images/avatar.png" alt="Admin SIM RS" class="navbar-profile-img">
          <span class="navbar-profile-name d-none d-md-inline">Admin Elektromedis</span>
          <i class="bi bi-chevron-down navbar-profile-caret"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile" aria-labelledby="profile-dropdown">
          <li class="dropdown-header">Selamat Datang!</li>
          <li><a class="dropdown-item" href="index.php"><i class="bi bi-house"></i> Dashboard</a></li>
          <li><a class="dropdown-item" href="add.php"><i class="bi bi-plus-circle"></i> Tambah Data</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item text-danger" href="index.php"><i class="bi bi-box-arrow-right"></i> Keluar</a></li>
        </ul>
      </div>
    </div>
  </header>
  <!-- ==========================================
       END: Top Navbar Component
       ========================================== -->
