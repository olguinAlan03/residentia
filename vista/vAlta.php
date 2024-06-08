<?php
include("../includes/top.php");
session_start();
$nombre = $_SESSION["usuario"];
$nombre = strtoupper($nombre);
?>
<script src="../controlador/cAlta.js"></script>
<input type='hidden' value="<?php echo $nombre; ?>" id="nombre">

<!-- Content Header (Page header) -->
<section class="content-header">

  <!-- Main content -->
  <section class="content">
    <section class="content">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h5 class="card-title m-0">ALTA ARÉA COMÚN</h5>

        </div>
        <div>
          <div class="row">
            <div class="col-sm-5">
            </div>
            <div class="col-sm-2"><br>
              <button id="agregar" class="btn btn-block btn-primary">AGREGAR</button>
            </div>
            <div class="col-sm-2"><br>
              <button id="regresar1" class="btn btn-block btn-primary">REGRESAR</button>
            </div>
            <div class="col-sm-2"><br>
              <button id="cerrar_sesion1" class="btn btn-block btn-primary">CERRAR SESIÓN</button>
            </div>
          </div>
          <div id="divTabAlta" class="card-body">
          </div>
        </div>
    </section>
  </section>

  <div class="modal fade" id="modal-registro">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Alta nueva aréa comun</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label>Nombre descriptivo del area:</label>
          <input id="nombre_area" type="text" class="form-control">
          <label>Tipo de area comun:</label>
          <input id="tipo_area" type="text" class="form-control">
          <label>Capacidad maxima:</label>
          <input id="capacidad" type="text" class="form-control">
          <label>Ubicacion</label>
          <input id="ubicacion" type="text" class="form-control">
          <label>Tarifa de alquiler</label>
          <input id="tarifa_alquiler" type="text" class="form-control">
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



  <!--<div id="DivTabla">
        
</div>-->
  <!-- /.content -->
  <?php
  include("../includes/footer.php");
  ?>