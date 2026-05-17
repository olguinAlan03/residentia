<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RESIDENTIA</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="/plugins/jquery/jquery.min.js"></script>
  <script src="/plugins/sweetAlert2/sweetalert2.all.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <span class="nav-link text-muted">
          <i class="fas fa-user-circle mr-1"></i>
          <?= htmlspecialchars($_SESSION['nombre'] ?? 'Administrador') ?>
        </span>
      </li>
      <li class="nav-item">
        <a class="nav-link text-danger" href="/logout">
          <i class="fas fa-sign-out-alt"></i> Salir
        </a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/dashboard" class="brand-link" style="background:#1a1a2e;">
      <img src="/dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity:.9">
      <span class="brand-text font-weight-light" style="color:#fff;">RESIDENTIA</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= htmlspecialchars($_SESSION['nombre'] ?? '') ?></a>
          <small class="text-muted">Administrador</small>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="/dashboard" class="nav-link <?= ($_SERVER['REQUEST_URI'] === '/dashboard') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
            </a>
          </li>

          <li class="nav-header">GESTIÓN</li>

          <li class="nav-item">
            <a href="/unidades" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], '/unidades') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-building"></i><p>Unidades</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/residentes" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], '/residentes') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-users"></i><p>Residentes</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/vehiculos" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], '/vehiculos') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-car"></i><p>Vehículos</p>
            </a>
          </li>

          <li class="nav-header">OPERACIONES</li>

          <li class="nav-item">
            <a href="/visitas" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], '/visitas') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-user-check"></i><p>Registro de Visitas</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/reservas" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], '/reservas') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-calendar-alt"></i><p>Reservas</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/cuotas" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], '/cuotas') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-dollar-sign"></i><p>Cuotas</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/incidentes" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], '/incidentes') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-exclamation-triangle"></i><p>Incidentes</p>
            </a>
          </li>

          <li class="nav-header">COMUNICACIÓN</li>

          <li class="nav-item">
            <a href="/avisos" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], '/avisos') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-bullhorn"></i><p>Avisos</p>
            </a>
          </li>

        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
