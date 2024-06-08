<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <script src="../controlador/cLogin.js"></script>
</head>
<body class="hold-transition login-page" style="background-image: url('../dist/img/rabello_log.jpg') ;"></body>
<!--<body class="hold-transition login-page" style="background:#B2DFDB"-->
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>RESIDENTIA</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">INICIAR SESIÓN</p>

        <form>
        <div class="input-group mb-3">
            <input id="clvresidente" type="text" class="form-control" placeholder="Clave Residente">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-solid fa-user"></span>

              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="usuario" type="text" class="form-control" placeholder="Usuario">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-solid fa-user"></span>

              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="pass" type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                <a href="vRegistro.php" class="text-center">
                  <!--<font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">¿No tienes cuenta?</font>
                    <font style="vertical-align: inherit;"> Registrate</font>
                  </font>
                  </font>
                </a>
                </label>
              </div>
            </div>

            <div class="col-4">
              <button id="inicio" class="btn btn-primary btn-block">ACCEDER</button>
              <!--<button type="button" class="btn btn-default swalDefaultQuestion">Launch Question Toast</button>-->
            </div>
          </div>
        </form>

        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>