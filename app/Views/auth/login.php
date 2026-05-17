<?php if (isset($_SESSION['residente'])) { header('Location: /'); exit(); } ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RESIDENTIA | Iniciar Sesión</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="/plugins/jquery/jquery.min.js"></script>
  <script src="/plugins/sweetAlert2/sweetalert2.all.min.js"></script>
  <script src="/assets/js/cLogin.js"></script>
</head>
<body class="hold-transition login-page" style="background-image:url('/dist/img/rabello_log.jpg');">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>RESIDENTIA</b></a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">INICIAR SESIÓN</p>
        <form>
          <div class="input-group mb-3">
            <input id="claveR" type="text" class="form-control" placeholder="Clave de Acceso">
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-user"></span></div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="pass" type="password" class="form-control" placeholder="Contraseña">
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <a href="/admin/login" class="text-muted">¿Eres administrador?</a>
            </div>
            <div class="col-4">
              <button id="inicio" type="button" class="btn btn-primary btn-block">ACCEDER</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/dist/js/adminlte.min.js"></script>
</body>
</html>
