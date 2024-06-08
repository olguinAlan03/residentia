<?php
include("../includes/top.php");
//session_start();
/*$nombre=$_SESSION["usuario"];
$nombre=strtoupper($nombre);*/
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
    <script src="../controlador/cTablaVehiculo.js"></script>
    <script src="../popper/popper.min.js"></script>
    <script src="../bootstrap4/js/bootstrap.min.js"></script>
    <script src="../plugins/sweetAlert2/sweetalert2.all.min.js"></script>
    <script src="../codigo.js"></script>

</head> 

    <input type='hidden' value="<?php echo $nombre; ?>" id="nombre">

<!-- Content Header (Page header) -->
<section class="content-header">

  <!-- Main content -->
  <section class="content">
    <section class="content">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h5 class="card-title m-0">VEHICULOS</h5>

        </div>
        <div>
          <div class="row">
            <div class="col-sm-5">
            </div>
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
          <div id="divTablaVehiculo" class="card-body">
          </div>
        </div>
    </section>
  </section>

  <!-- MODAL QUE REGISTRA AL RESIDENTE -->

  <div class="modal fade" id="modal-registro">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registro residente</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label>Marca:</label>
          <input id="marca" type="text" class="form-control">
          <label>Modelo:</label>
          <input id="modelo" type="text" class="form-control">
          <label>Color:</label>
          <input id="color" type="text" class="form-control">
          <label>Matricula:</label>
          <input id="n_matricula" type="text" class="form-control">
          </select>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button id="guardar" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- MODAL QUE REGISTRA EL DOMICILIO DEL RESIDENTE -->

  <div class="modal fade" id="modal_casa">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar datos de domicilio</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label>Calle:</label>
          <input id="calle" type="text" class="form-control">
          <label>Numero exterior:</label>
          <input id="n_ext" type="text" class="form-control">
          <label>Codigo postal:</label>
          <input id="c_p" type="text" class="form-control">
          <label>Status:</label>
          <input id="estatus" type="text" class="form-control">
          <label>Modelo:</label>
          <input id="modelo" type="text" class="form-control">
          <label>Numero de habitantes:</label>
          <input id="n_habitantes" type="text" class="form-control">
          <label>Numero de vehiculos:</label>
          <input id="n_vehiculos" type="text" class="form-control">
          </select>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button id="guardarCasa" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
      <!-- /.modal-content -->
   </div>
    <!-- /.modal-dialog -->
 </div>
  <!-- /.modal -->

  <!-- MODAL QUE MUESTRA LOS DATOS DE LA CASA -->
  <div class="modal fade" id="modal-domicilio">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Datos de domicilio</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label>Calle:</label>
        
          <label>Numero exterior:</label>

          <label>Codigo postal:</label>

          <label>Status:</label>

          <label>Modelo:</label>
   
          <label>Numero de habitantes:</label>
  
          <label>Numero de vehiculos:</label>
   
        </div>
        <div class="modal-footer justify-content-between">
          <button id="MuestraCasa" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <?php
  include("../includes/footer.php");
  ?>