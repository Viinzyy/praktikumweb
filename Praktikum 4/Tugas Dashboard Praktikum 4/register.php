<?php
/**
 * Halaman Registrasi Pengguna Baru - SIM RS
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
$nama_awal  = "";
$nama_akhir = "";
$username   = "";
$email      = "";

// Proses Form Registrasi
if (isset($_POST['register'])) {
    $nama_awal           = isset($_POST['nama_awal']) ? trim($_POST['nama_awal']) : '';
    $nama_akhir          = isset($_POST['nama_akhir']) ? trim($_POST['nama_akhir']) : '';
    $username            = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email               = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password            = isset($_POST['password']) ? $_POST['password'] : '';
    $konfirmasi_password = isset($_POST['konfirmasi_password']) ? $_POST['konfirmasi_password'] : '';

    // Validasi Kelengkapan Data
    if (empty($nama_awal) || empty($nama_akhir) || empty($email) || empty($password) || empty($konfirmasi_password)) {
        $error_msg = "Harap isi semua kolom formulir pendaftaran!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg = "Format email tidak valid!";
    } elseif (strlen($password) < 6) {
        $error_msg = "Password minimal terdiri dari 6 karakter!";
    } elseif ($password !== $konfirmasi_password) {
        $error_msg = "Konfirmasi password tidak cocok dengan password!";
    } elseif (!$db_connected) {
        $error_msg = "Koneksi database terputus. Pastikan MySQL di XAMPP sudah berjalan.";
    } else {
        // Jika username kosong, buat otomatis dari nama awal dan akhir
        if (empty($username)) {
            $username = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $nama_awal . $nama_akhir));
        } else {
            $username = strtolower(preg_replace('/[^a-zA-Z0-9._-]/', '', $username));
        }

        $safe_email    = mysqli_real_escape_string($mysqli, $email);
        $safe_username = mysqli_real_escape_string($mysqli, $username);
        $safe_awal     = mysqli_real_escape_string($mysqli, $nama_awal);
        $safe_akhir    = mysqli_real_escape_string($mysqli, $nama_akhir);

        // Cek apakah email sudah terdaftar
        $check_email = mysqli_query($mysqli, "SELECT id FROM users WHERE email='$safe_email' LIMIT 1");
        if ($check_email && mysqli_num_rows($check_email) > 0) {
            $error_msg = "Email sudah digunakan oleh pengguna lain!";
        } else {
            // Cek apakah username sudah terdaftar
            $check_user = mysqli_query($mysqli, "SELECT id FROM users WHERE username='$safe_username' LIMIT 1");
            if ($check_user && mysqli_num_rows($check_user) > 0) {
                // Tambahkan angka acak di belakang username jika bentrok
                $safe_username .= rand(10, 99);
            }

            // Enkripsi password menggunakan algoritma Bcrypt yang aman
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Simpan pengguna baru ke tabel users
            $insert_query = "INSERT INTO users (nama_awal, nama_akhir, username, email, password) 
                             VALUES ('$safe_awal', '$safe_akhir', '$safe_username', '$safe_email', '$hashed_password')";
            
            $insert = mysqli_query($mysqli, $insert_query);

            if ($insert) {
                header("Location: login.php?msg=registered");
                exit;
            } else {
                $error_msg = "Gagal mendaftarkan akun: " . mysqli_error($mysqli);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi Akun - SIM RS Dashboard</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="assets/images/favicon.ico">

  <!-- Local Libraries -->
  <link rel="stylesheet" href="assets/libs/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/libs/bootstrap-icons/bootstrap-icons.css">

  <!-- Main Spark Admin Custom Stylesheet -->
  <link rel="stylesheet" href="assets/css/main.css">
  <style>
    .register-card {
      max-width: 520px;
      width: 100%;
    }
    .username-preview {
      font-size: 0.78rem;
      color: #7ab300;
      margin-top: 0.25rem;
      font-weight: 600;
    }
  </style>
</head>

<body>
  <!-- START: Authentication Container -->
  <div class="login-wrapper py-5">
    <!-- Glowing background shapes -->
    <div class="login-bg-shape login-bg-shape-1"></div>
    <div class="login-bg-shape login-bg-shape-2"></div>

    <!-- Main registration card -->
    <div class="login-card register-card">

      <!-- Brand Identity -->
      <a href="login.php" class="login-brand text-decoration-none">
        <i class="bi bi-hospital"></i>
        <span>SIM RS Spark</span>
      </a>

      <p class="login-subtitle">Daftar akun baru untuk mengakses inventaris alat elektromedis</p>

      <!-- Error Feedback -->
      <?php if (!empty($error_msg)): ?>
        <div class="alert-custom alert-custom-danger mb-3 p-2 small">
          <i class="bi bi-exclamation-circle-fill me-2"></i>
          <span><?php echo htmlspecialchars($error_msg); ?></span>
        </div>
      <?php endif; ?>

      <!-- Register Form -->
      <form action="register.php" method="POST" id="registerForm">
        
        <!-- Nama Awal & Nama Akhir (2 Kolom) -->
        <div class="row g-2 mb-3">
          <div class="col-6">
            <label for="nama_awal" class="login-form-label">Nama Awal <span class="text-danger">*</span></label>
            <div class="login-input-group">
              <i class="bi bi-person input-icon"></i>
              <input type="text" id="nama_awal" name="nama_awal" class="login-input"
                     placeholder="Nama depan" required autofocus
                     value="<?php echo htmlspecialchars($nama_awal); ?>">
            </div>
          </div>
          <div class="col-6">
            <label for="nama_akhir" class="login-form-label">Nama Akhir <span class="text-danger">*</span></label>
            <div class="login-input-group">
              <i class="bi bi-person input-icon"></i>
              <input type="text" id="nama_akhir" name="nama_akhir" class="login-input"
                     placeholder="Nama belakang" required
                     value="<?php echo htmlspecialchars($nama_akhir); ?>">
            </div>
          </div>
        </div>

        <!-- Username (Otomatis / Kustom) -->
        <div class="login-form-group mb-3">
          <label for="username" class="login-form-label">Username (Opsional / Otomatis dari Nama)</label>
          <div class="login-input-group">
            <i class="bi bi-at input-icon"></i>
            <input type="text" id="username" name="username" class="login-input"
                   placeholder="Contoh: isakhuzaini"
                   value="<?php echo htmlspecialchars($username); ?>">
          </div>
          <div class="username-preview" id="usernameHint">
            <i class="bi bi-info-circle"></i> Username akan terisi otomatis berdasarkan nama Anda.
          </div>
        </div>

        <!-- Email Input -->
        <div class="login-form-group mb-3">
          <label for="email" class="login-form-label">Alamat Email <span class="text-danger">*</span></label>
          <div class="login-input-group">
            <i class="bi bi-envelope input-icon"></i>
            <input type="email" id="email" name="email" class="login-input"
                   placeholder="dokter@rs-elektro.id" required
                   value="<?php echo htmlspecialchars($email); ?>">
          </div>
        </div>

        <!-- Password Input -->
        <div class="login-form-group mb-3">
          <label for="password" class="login-form-label">Password <span class="text-danger">*</span></label>
          <div class="login-input-group">
            <i class="bi bi-shield-lock input-icon"></i>
            <input type="password" id="password" name="password" class="login-input login-input-password"
                   placeholder="Minimal 6 karakter" required minlength="6">
            <button type="button" class="password-toggle-btn" id="togglePasswordBtn1" aria-label="Lihat Password">
              <i class="bi bi-eye" id="toggleIcon1"></i>
            </button>
          </div>
        </div>

        <!-- Konfirmasi Password Input -->
        <div class="login-form-group mb-4">
          <label for="konfirmasi_password" class="login-form-label">Konfirmasi Password <span class="text-danger">*</span></label>
          <div class="login-input-group">
            <i class="bi bi-shield-check input-icon"></i>
            <input type="password" id="konfirmasi_password" name="konfirmasi_password" class="login-input login-input-password"
                   placeholder="Ulangi password di atas" required minlength="6">
            <button type="button" class="password-toggle-btn" id="togglePasswordBtn2" aria-label="Lihat Password">
              <i class="bi bi-eye" id="toggleIcon2"></i>
            </button>
          </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" name="register" class="btn-login">
          <span>Daftar Akun Sekarang</span>
          <i class="bi bi-person-plus-fill"></i>
        </button>
      </form>

      <!-- Footer Link to Login -->
      <p class="login-footer-text mt-4">
        Sudah memiliki akun? <a href="login.php" class="fw-bold">Masuk di Sini</a>
      </p>

    </div>
  </div>
  <!-- END: Authentication Container -->

  <!-- Local Bootstrap bundle -->
  <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Auto-generate username & password toggles -->
  <script>
    const inputAwal = document.getElementById('nama_awal');
    const inputAkhir = document.getElementById('nama_akhir');
    const inputUser = document.getElementById('username');
    const userHint = document.getElementById('usernameHint');

    function updateUsername() {
      // Hanya buat otomatis jika input username belum diisi secara manual oleh user
      if (inputUser && (!inputUser.dataset.custom || inputUser.dataset.custom === 'false')) {
        const awal = (inputAwal.value || '').toLowerCase().replace(/[^a-z0-9]/g, '');
        const akhir = (inputAkhir.value || '').toLowerCase().replace(/[^a-z0-9]/g, '');
        if (awal || akhir) {
          inputUser.value = awal + (akhir ? '.' + akhir : '');
          userHint.innerHTML = '<i class="bi bi-check-circle"></i> Username disarankan: <strong>@' + inputUser.value + '</strong>';
        }
      }
    }

    if (inputAwal) inputAwal.addEventListener('input', updateUsername);
    if (inputAkhir) inputAkhir.addEventListener('input', updateUsername);
    if (inputUser) {
      inputUser.addEventListener('input', function() {
        this.dataset.custom = this.value.trim() ? 'true' : 'false';
      });
    }

    // Toggle Password 1
    function setupToggle(btnId, inputId, iconId) {
      const btn = document.getElementById(btnId);
      const input = document.getElementById(inputId);
      const icon = document.getElementById(iconId);
      if (btn && input && icon) {
        btn.addEventListener('click', function() {
          if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
          } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
          }
        });
      }
    }
    setupToggle('togglePasswordBtn1', 'password', 'toggleIcon1');
    setupToggle('togglePasswordBtn2', 'konfirmasi_password', 'toggleIcon2');
  </script>
</body>

</html>
