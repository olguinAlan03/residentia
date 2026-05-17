<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RESIDENTIA — Gestión de Condominios</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=fallback">
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <style>
    :root { --primary: #1a1a2e; --accent: #e94560; }
    body { font-family: 'Source Sans Pro', sans-serif; }
    .hero {
      min-height: 100vh;
      background: linear-gradient(135deg, rgba(26,26,46,.85) 0%, rgba(233,69,96,.7) 100%),
                  url('/img/row-houses-196105_1920.jpg') center/cover no-repeat;
      display: flex; align-items: center; color: #fff;
    }
    .hero h1 { font-size: 3.5rem; font-weight: 700; letter-spacing: 2px; }
    .hero p  { font-size: 1.25rem; opacity: .9; }
    .navbar-landing { position: fixed; top: 0; width: 100%; z-index: 999;
                      background: rgba(26,26,46,.95); backdrop-filter: blur(10px); }
    .navbar-landing .navbar-brand { color: #fff; font-weight: 700; font-size: 1.4rem; }
    .feature-card { border: none; border-radius: 12px; transition: transform .3s, box-shadow .3s; }
    .feature-card:hover { transform: translateY(-6px); box-shadow: 0 12px 30px rgba(0,0,0,.15); }
    .feature-icon { width: 64px; height: 64px; border-radius: 50%; display: flex;
                    align-items: center; justify-content: center; font-size: 1.6rem; margin: 0 auto 1rem; }
    .section-title { font-size: 2rem; font-weight: 700; color: var(--primary); }
    footer { background: var(--primary); color: rgba(255,255,255,.7); }
    .btn-accent { background: var(--accent); border-color: var(--accent); color: #fff; }
    .btn-accent:hover { background: #c73652; border-color: #c73652; color: #fff; }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-landing">
  <a class="navbar-brand ml-3" href="/"><i class="fas fa-building mr-2"></i>RESIDENTIA</a>
  <div class="ml-auto mr-3">
    <a href="/login" class="btn btn-outline-light btn-sm mr-2">
      <i class="fas fa-user mr-1"></i> Residente
    </a>
    <a href="/admin/login" class="btn btn-accent btn-sm">
      <i class="fas fa-shield-alt mr-1"></i> Administrador
    </a>
  </div>
</nav>

<!-- Hero -->
<section class="hero">
  <div class="container text-center">
    <h1 class="mb-3"><i class="fas fa-building mr-3"></i>RESIDENTIA</h1>
    <p class="mb-4">Sistema integral de gestión para condominios residenciales.<br>
      Control total desde un solo lugar.</p>
    <a href="/login" class="btn btn-accent btn-lg mr-3 px-4">
      <i class="fas fa-sign-in-alt mr-2"></i>Iniciar sesión
    </a>
    <a href="#features" class="btn btn-outline-light btn-lg px-4">
      <i class="fas fa-info-circle mr-2"></i>Conocer más
    </a>
  </div>
</section>

<!-- Features -->
<section id="features" class="py-5 bg-light">
  <div class="container">
    <h2 class="section-title text-center mb-5">Todo lo que necesitas</h2>
    <div class="row">

      <div class="col-md-4 mb-4">
        <div class="card feature-card p-4 text-center h-100">
          <div class="feature-icon bg-info text-white mx-auto"><i class="fas fa-users"></i></div>
          <h5 class="font-weight-bold">Gestión de Residentes</h5>
          <p class="text-muted">Administra la información de todos los habitantes del condominio, sus unidades y accesos.</p>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="card feature-card p-4 text-center h-100">
          <div class="feature-icon bg-success text-white mx-auto"><i class="fas fa-calendar-check"></i></div>
          <h5 class="font-weight-bold">Reservas de Áreas</h5>
          <p class="text-muted">Reserva salón de eventos, alberca, gimnasio y más áreas comunes sin conflictos.</p>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="card feature-card p-4 text-center h-100">
          <div class="feature-icon bg-warning text-white mx-auto"><i class="fas fa-dollar-sign"></i></div>
          <h5 class="font-weight-bold">Control de Cuotas</h5>
          <p class="text-muted">Seguimiento de pagos de mantenimiento, estados de cuenta y alertas de vencimiento.</p>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="card feature-card p-4 text-center h-100">
          <div class="feature-icon bg-danger text-white mx-auto"><i class="fas fa-user-check"></i></div>
          <h5 class="font-weight-bold">Registro de Visitas</h5>
          <p class="text-muted">Control de acceso de visitantes con registro de entrada y salida en tiempo real.</p>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="card feature-card p-4 text-center h-100">
          <div class="feature-icon bg-primary text-white mx-auto"><i class="fas fa-exclamation-triangle"></i></div>
          <h5 class="font-weight-bold">Incidentes</h5>
          <p class="text-muted">Reporta y da seguimiento a problemas de mantenimiento con prioridades y estados.</p>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="card feature-card p-4 text-center h-100">
          <div class="feature-icon bg-secondary text-white mx-auto"><i class="fas fa-bullhorn"></i></div>
          <h5 class="font-weight-bold">Avisos y Comunicados</h5>
          <p class="text-muted">Publica comunicados y noticias que los residentes verán al iniciar sesión.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Stats -->
<section class="py-5" style="background:var(--primary); color:#fff;">
  <div class="container">
    <div class="row text-center">
      <div class="col-md-3 mb-3">
        <h2 class="font-weight-bold" style="color:var(--accent)">100%</h2>
        <p>Web — sin instalar nada</p>
      </div>
      <div class="col-md-3 mb-3">
        <h2 class="font-weight-bold" style="color:var(--accent)">24/7</h2>
        <p>Acceso desde cualquier dispositivo</p>
      </div>
      <div class="col-md-3 mb-3">
        <h2 class="font-weight-bold" style="color:var(--accent)">+8</h2>
        <p>Módulos de gestión integrados</p>
      </div>
      <div class="col-md-3 mb-3">
        <h2 class="font-weight-bold" style="color:var(--accent)">MVC</h2>
        <p>Arquitectura moderna y escalable</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="py-5 bg-light text-center">
  <div class="container">
    <h3 class="section-title mb-3">¿Listo para comenzar?</h3>
    <p class="text-muted mb-4">Accede al sistema con las credenciales que te proporcionó tu administrador.</p>
    <a href="/login" class="btn btn-accent btn-lg px-5">
      <i class="fas fa-sign-in-alt mr-2"></i>Acceder ahora
    </a>
  </div>
</section>

<footer class="py-4 text-center">
  <p class="mb-0">RESIDENTIA &copy; <?= date('Y') ?> — Sistema de Gestión de Condominios</p>
</footer>

<script src="/plugins/jquery/jquery.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
