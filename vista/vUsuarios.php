  <?php
  include("../includes/top.php");
  session_start();
  $nombre = isset($_SESSION["usuario"]) ? strtoupper($_SESSION["usuario"]) : '';
  ?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RESIDENTIA | Página de registro</title>
    

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="../dist/css/adminlte.min.css?v=3.2.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">

    <link rel="stylesheet" href="../plugins/animate.css/animate.css">

    <link rel="stylesheet" href="../estilos.css">

    <!-- daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../popper/popper.min.js"></script>
    <script src="../bootstrap4/js/bootstrap.min.js"></script>
    <script src="../plugins/sweetAlert2/sweetalert2.all.min.js"></script>
    <script src="../codigo.js"></script>
    
</head>

  <script src="../controlador/cTabla.js"></script>
  <input type='hidden' value="<?php echo $nombre; ?>" id="nombre">

  <!-- Content Header (Page header) -->
  <section class="content-header">

    <!-- Main content -->
    <section class="content">
    <section class="content">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="card-title m-0" >USUARIOS</h5>
      </div>
      <div>
        <div class="row">
          <div class="col-sm-5"></div>
          <div class="col-sm-2"><br>
            <button id="agregar" class="btn btn-block btn-primary">AGREGAR</button>
          </div>
          <div class="col-sm-2"><br>
            <button id="regresar" class="btn btn-block btn-primary">REGRESAR</button>
          </div>
          <div class="col-sm-2"><br>
            <button id="cerrar_sesion" class="btn btn-block btn-primary">CERRAR SESIÓN</button>
          </div>
        </div>
        <div id="divTablaUsuario" class="card-body"></div>
      </div>
    </div>
    </section>
  </section>

  <!-- Modal para registar nuevo usuario -->
  <div class="modal fade" id="modal-registro">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registro nuevo Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label>Nombre:</label>
          <input id="nombre_usuario" type="text" class="form-control">
          <label>Apellido Paterno:</label>
          <input id="a_paterno" type="text" class="form-control">
          <label>Apellido Materno:</label>
          <input id="a_materno" type="text" class="form-control">
          <label>Telefono:</label>
          <input id="telefono" type="text" class="form-control">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button id="guardar" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para registar casa -->
  <div class="modal fade" id="modal-casa">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registro nueva Casa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label>Calle:</label>
          <input id="calle" type="text" class="form-control">
          <label>Número Exterior:</label>
          <input id="n_ext" type="number" class="form-control">
          <label>Código Postal:</label>
          <input id="c_p" type="number" class="form-control">
          <label>Estatus:</label>
          <input id="estatus" type="text" class="form-control">
          <label>Modelo:</label>
          <input id="modelo" type="text" class="form-control">
          <label>Número de Habitantes:</label>
          <input id="n_habitantes" type="number" class="form-control">
          <label>Número de Vehículos:</label>
          <input id="n_vehiculos" type="number" class="form-control">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button id="guardarCasa" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal para consultar casa -->
  <div class="modal fade" id="modal-consultar-casa">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Datos de Casa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="divTablaCasa">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal para modificar datos de casa -->
  <div class="modal fade" id="modal-modificar-casa">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modificar Casa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label>Calle:</label>
          <input id="modificar_calle" type="text" class="form-control">
          <label>Número Exterior:</label>
          <input id="modificar_num_exterior" type="text" class="form-control">
          <label>Código Postal:</label>
          <input id="modificar_codigo_postal" type="text" class="form-control">
          <label>Estatus:</label>
          <input id="modificar_estatus" type="text" class="form-control">
          <label>Modelo:</label>
          <input id="modificar_modelo" type="text" class="form-control">
          <label>Número de Habitantes:</label>
          <input id="modificar_num_habitantes" type="text" class="form-control">
          <label>Número de Vehículos:</label>
          <input id="modificar_num_vehiculos" type="text" class="form-control">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button id="guardarModificacion" type="button" class="btn btn-primary">Guardar Cambios</button>
        </div>
      </div>
    </div>
  </div>

  <?php
  include("../includes/footer.php");
  ?>
