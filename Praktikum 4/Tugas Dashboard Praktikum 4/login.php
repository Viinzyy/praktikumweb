<?php
/**
 * Halaman Login - SIM RS
 * Template: Spark Admin Bootstrap 5
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika sudah login, langsung alihkan ke Dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

include_once("config.php");

$error_msg = "";
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';

// Proses Form Login
if (isset($_POST['login'])) {
    $identity = isset($_POST['identity']) ? trim($_POST['identity']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (empty($identity) || empty($password)) {
        $error_msg = "Harap masukkan Email / Username dan Password!";
    } elseif (!$db_connected) {
        $error_msg = "Koneksi database terputus. Pastikan MySQL di XAMPP sudah aktif.";
    } else {
        $safe_identity = mysqli_real_escape_string($mysqli, $identity);
        
        // Cari pengguna berdasarkan email ATAU username
        $query = "SELECT * FROM users WHERE email='$safe_identity' OR username='$safe_identity' LIMIT 1";
        $result = mysqli_query($mysqli, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            // Verifikasi Password menggunakan hash Bcrypt
            if (password_verify($password, $user['password'])) {
                // Set sesi login
                $_SESSION['user_id']      = $user['id'];
                $_SESSION['username']     = $user['username'];
                $_SESSION['nama_awal']    = $user['nama_awal'];
                $_SESSION['nama_akhir']   = $user['nama_akhir'];
                $_SESSION['nama_lengkap'] = $user['nama_awal'] . ' ' . $user['nama_akhir'];
                $_SESSION['email']        = $user['email'];

                header("Location: index.php");
                exit;
            } else {
                $error_msg = "Password yang Anda masukkan salah!";
            }
        } else {
            $error_msg = "Akun dengan Email atau Username tersebut tidak ditemukan!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SIM RS Dashboard</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="assets/images/favicon.ico">

  <!-- Local Libraries -->
  <link rel="stylesheet" href="assets/libs/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/libs/bootstrap-icons/bootstrap-icons.css">

  <!-- Main Spark Admin Custom Stylesheet -->
  <link rel="stylesheet" href="assets/css/main.css">
  <style>
    /* Custom enhancements for auth forms */
    .login-card {
      max-width: 440px;
      width: 100%;
    }
    .demo-hint {
      background: rgba(180, 241, 5, 0.08);
      border: 1px dashed rgba(180, 241, 5, 0.5);
      border-radius: 8px;
      padding: 0.65rem 0.85rem;
      font-size: 0.8rem;
      color: #64748b;
    }
  </style>
</head>

<body>
  <!-- START: Authentication Container -->
  <div class="login-wrapper">
    <!-- Glowing background shapes -->
    <div class="login-bg-shape login-bg-shape-1"></div>
    <div class="login-bg-shape login-bg-shape-2"></div>

    <!-- Main centered login card -->
    <div class="login-card">

      <!-- Brand Identity -->
      <a href="login.php" class="login-brand text-decoration-none">
        <i class="bi bi-hospital"></i>
        <span>SIM RS Spark</span>
      </a>

      <p class="login-subtitle">Masuk ke sistem manajemen inventaris alat elektromedis</p>

      <!-- Feedback Alerts -->
      <?php if (!empty($error_msg)): ?>
        <div class="alert-custom alert-custom-danger mb-3 p-2 small">
          <i class="bi bi-exclamation-circle-fill me-2"></i>
          <span><?php echo htmlspecialchars($error_msg); ?></span>
        </div>
      <?php endif; ?>

      <?php if ($msg === 'registered'): ?>
        <div class="alert-custom alert-custom-success mb-3 p-2 small">
          <i class="bi bi-check-circle-fill me-2"></i>
          <span>Pendaftaran berhasil! Silakan masuk menggunakan akun baru Anda.</span>
        </div>
      <?php elseif ($msg === 'logout'): ?>
        <div class="alert-custom alert-custom-primary mb-3 p-2 small">
          <i class="bi bi-info-circle-fill me-2"></i>
          <span>Anda telah berhasil keluar (logout) dari sistem.</span>
        </div>
      <?php elseif ($msg === 'unauthorized'): ?>
        <div class="alert-custom alert-custom-warning mb-3 p-2 small">
          <i class="bi bi-shield-lock-fill me-2"></i>
          <span>Silakan login terlebih dahulu untuk mengakses dashboard.</span>
        </div>
      <?php endif; ?>

      <!-- Login Form -->
      <form action="login.php" method="POST" id="loginForm">
        <!-- Identity Input (Email or Username) -->
        <div class="login-form-group">
          <label for="identity" class="login-form-label">Email atau Username</label>
          <div class="login-input-group">
            <i class="bi bi-person input-icon"></i>
            <input type="text" id="identity" name="identity" class="login-input"
                   placeholder="admin atau email@rs.id" required autofocus
                   value="<?php echo isset($_POST['identity']) ? htmlspecialchars($_POST['identity']) : ''; ?>">
          </div>
        </div>

        <!-- Password Input -->
        <div class="login-form-group">
          <label for="password" class="login-form-label">Password</label>
          <div class="login-input-group">
            <i class="bi bi-shield-lock input-icon"></i>
            <input type="password" id="password" name="password" class="login-input login-input-password"
                   placeholder="••••••••" required>
            <button type="button" class="password-toggle-btn" id="togglePasswordBtn" aria-label="Lihat Password">
              <i class="bi bi-eye" id="toggleIcon"></i>
            </button>
          </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" name="login" class="btn-login mt-3">
          <span>Masuk ke Dashboard</span>
          <i class="bi bi-arrow-right"></i>
        </button>
      </form>

      <!-- Demo Account Information -->
      <div class="demo-hint mt-4 text-center">
        <i class="bi bi-key-fill text-success me-1"></i>
        Akun Bawaan: <strong>admin</strong> | Password: <strong>admin123</strong>
      </div>

      <!-- Footer Link to Register -->
      <p class="login-footer-text mt-4">
        Belum memiliki akun? <a href="register.php" class="fw-bold">Daftar Akun Baru</a>
      </p>

    </div>
  </div>
  <!-- END: Authentication Container -->

  <!-- Local Bootstrap bundle -->
  <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Password toggle script -->
  <script>
    const toggleBtn = document.getElementById('togglePasswordBtn');
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    if (toggleBtn && passwordInput && toggleIcon) {
      toggleBtn.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
          passwordInput.type = 'password';
          toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
        }
      });
    }
  </script>
</body>

</html>
