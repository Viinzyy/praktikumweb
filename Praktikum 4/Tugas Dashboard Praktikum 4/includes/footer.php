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
        <li><a href="add.php" class="footer-link">Tambah Data</a></li>
        <li><a href="#" class="footer-link" onclick="window.scrollTo({top:0, behavior:'smooth'}); return false;">Kembali ke Atas <i class="bi bi-arrow-up-short"></i></a></li>
      </ul>
    </div>
  </footer>
  <!-- END: Footer Component -->

  <!-- Local Third-Party Libraries Script dependencies -->
  <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
  <script src="assets/libs/flatpickr/flatpickr.min.js"></script>

  <!-- Local dashboard interactions controller -->
  <script src="assets/js/dashboard.js"></script>

  <!-- Live Table Search Script -->
  <script>
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
