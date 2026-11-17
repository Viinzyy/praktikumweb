<?php
if (!isset($page_title)) {
    $page_title = "SIM RS - Dashboard Data Alat Elektromedis";
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($page_title); ?> - Spark Admin</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="assets/images/favicon.ico">

  <!-- Local Third-Party Libraries (100% Offline Compatible) -->
  <link rel="stylesheet" href="assets/libs/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/libs/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/libs/apexcharts/apexcharts.css">
  <link rel="stylesheet" href="assets/libs/flatpickr/flatpickr.min.css">
  <link rel="stylesheet" href="assets/libs/sweetalert2/sweetalert2.min.css">

  <!-- Main Spark Admin Design System & Custom Stylesheet -->
  <link rel="stylesheet" href="assets/css/main.css">

  <style>
    /* Custom tweaks for SIM RS Project */
    .badge-room {
      background: rgba(180, 241, 5, 0.15);
      color: #7ab300;
      border: 1px solid rgba(180, 241, 5, 0.4);
      padding: 0.35rem 0.65rem;
      border-radius: 999px;
      font-size: 0.75rem;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
    }
    .badge-brand {
      background: #f1f5f9;
      color: #334155;
      padding: 0.35rem 0.65rem;
      border-radius: 6px;
      font-size: 0.78rem;
      font-weight: 600;
    }
    .badge-year {
      background: rgba(13, 110, 253, 0.1);
      color: #0d6efd;
      padding: 0.35rem 0.6rem;
      border-radius: 6px;
      font-weight: 600;
      font-size: 0.78rem;
    }
    .stat-icon-wrapper {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
    }
  </style>
</head>

<body>
