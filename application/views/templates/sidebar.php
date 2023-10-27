<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-dark bg-purple">
    <!-- Left navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo site_url('login/logout')?>" class="nav-link">Keluar</a>
      </li>
</ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-secondary bg-purple elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo" class="brand-image">
      <span class="brand-text font-weight-light text-sm">PT. Sumber Bukit Caringin </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/template/') ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
                <a href="<?= base_url('dashboard') ?>" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
              </li>

          <li class="nav-item">
                <a href="<?= base_url('masterkonsumen') ?>" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Master Konsumen</p>
                </a>
              </li>

          <li class="nav-item">
                <a href="<?= base_url('kasir') ?>" class="nav-link">
                  <i class="nav-icon fas fa-cash-register"></i>
                  <p>Kasir</p>
                </a>
              </li>

          <li class="nav-item">
                <a href="<?= base_url('riwayatpenjualan') ?>" class="nav-link">
                  <i class="nav-icon fas fa-money-bill"></i>
                  <p>Riwayat Penjualan</p>
                </a>
              </li>

          <li class="nav-item">
                <a href="<?= base_url('rankingkonsumen') ?>" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Rangking Konsumen</p>
                </a>
              </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $title ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
