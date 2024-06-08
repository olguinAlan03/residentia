<?php
include("../includes/top.php");
/*session_start();
$nombre=$_SESSION["usuario"];
$nombre=strtoupper($nombre);*/
?>
<script src="../controlador/cTabReserva.js"></script>
<input type='hidden' value="<?php echo $nombre; ?>" id="nombre">

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1></h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->

 
  <!-- Main content -->
  <section class="content">
  <section class="content">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h5 class="card-title m-0" >RESERVAS DE AREA COMÚN</h5>

    </div>
      <div>
        <div class="row">
          <div class="col-sm-7">
          </div>
          <div class="col-sm-2"><br>
            <button id="regresar1" class="btn btn-block btn-primary">REGRESAR</button>
          </div>
          <div class="col-sm-2"><br>
            <button id="cerrar_sesion1" class="btn btn-block btn-primary">CERRAR SESIÓN</button>
          </div>
          </div>
      <div id="divTablaRE" class="card-body">
      </div>
    </div>
  </section>
</section>

<!-- /.modal -->


<!--<div id="DivTabla">
        
</div>-->
<!-- /.content -->
<?php
include("../includes/footer.php");
?>