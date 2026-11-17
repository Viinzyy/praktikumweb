  <!-- START: Footer Component -->
  <footer class="footer-custom">
    <div class="footer-left">
      <span class="footer-logo">
        <i class="bi bi-hospital"></i> SIM RS Dashboard
      </span>
      <span class="footer-separator">|</span>
      <span class="footer-copy">&copy; 2026 Praktikum Web - Tugas Dashboard Praktikum 4 (Spark Admin Template)</span>
    </div>
    <div class="footer-right">
      <ul class="footer-links">
        <li><a href="index.php" class="footer-link">Dashboard</a></li>
        <li><a href="#" class="footer-link" data-bs-toggle="modal" data-bs-target="#modalTambahAlat">Tambah Data</a></li>
        <li><a href="#" class="footer-link" onclick="window.scrollTo({top:0, behavior:'smooth'}); return false;">Kembali ke Atas <i class="bi bi-arrow-up-short"></i></a></li>
      </ul>
    </div>
  </footer>
  <!-- END: Footer Component -->

  <!-- Local Third-Party Libraries Script dependencies -->
  <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
  <script src="assets/libs/flatpickr/flatpickr.min.js"></script>
  <script src="assets/libs/sweetalert2/sweetalert2.all.min.js"></script>

  <!-- Local dashboard interactions controller -->
  <script src="assets/js/dashboard.js"></script>

  <!-- SweetAlert2 Helper & Live Search Scripts -->
  <script>
    // Konfigurasi Toast Global SweetAlert2
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
      }
    });

    // Konfirmasi Hapus Data dengan SweetAlert2
    function confirmDelete(url, itemName) {
      Swal.fire({
        title: 'Hapus Data Alat?',
        html: `Apakah Anda yakin ingin menghapus data alat <strong>"${itemName}"</strong> dari sistem SIM RS?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e11d48',
        cancelButtonColor: '#64748b',
        confirmButtonText: '<i class="bi bi-trash-fill me-1"></i> Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        focusCancel: true,
        customClass: {
          popup: 'rounded-4 shadow-lg'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url;
        }
      });
      return false;
    }

    // Konfirmasi Logout dengan SweetAlert2
    function confirmLogout(url = 'logout.php') {
      Swal.fire({
        title: 'Keluar dari Sistem?',
        text: 'Sesi login Anda akan diakhiri dan dialihkan ke halaman login.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#e11d48',
        cancelButtonColor: '#64748b',
        confirmButtonText: '<i class="bi bi-box-arrow-right me-1"></i> Ya, Keluar',
        cancelButtonText: 'Tetap di Sini',
        reverseButtons: true,
        customClass: {
          popup: 'rounded-4 shadow-lg'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url;
        }
      });
      return false;
    }

    // Filter Tabel Real-Time
    function filterTable(query) {
      const q = (query || '').toLowerCase().trim();
      const rows = document.querySelectorAll('#tableAlat tbody tr.alat-row');
      let visibleCount = 0;

      rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        if (text.includes(q)) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      const noDataRow = document.getElementById('noFilterResult');
      if (noDataRow) {
        if (visibleCount === 0 && rows.length > 0) {
          noDataRow.style.display = '';
        } else {
          noDataRow.style.display = 'none';
        }
      }
    }

    const tableSearchInput = document.getElementById('tableSearchInput');
    if (tableSearchInput) {
      tableSearchInput.addEventListener('input', function() {
        filterTable(this.value);
      });
    }

    const navbarSearchInput = document.getElementById('navbarLiveSearch');
    if (navbarSearchInput) {
      navbarSearchInput.addEventListener('input', function() {
        if (tableSearchInput) tableSearchInput.value = this.value;
        filterTable(this.value);
      });
    }

    function focusSearch() {
      const input = document.getElementById('tableSearchInput') || document.getElementById('navbarLiveSearch');
      if (input) {
        input.focus();
        input.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
    }
  </script>
</body>
</html>
