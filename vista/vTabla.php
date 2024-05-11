<?php
include("../includes/top.php");
session_start();
$nombre=$_SESSION["usuario"];
$nombre=strtoupper($nombre);
?>
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
      <div id="divTablaReserva" class="card-body">
      </div>
    </div>
  </section>
</section>

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
        <label>Correo</label>
        <input id="correo" type="text" class="form-control">
        <label>Telefono</label>
        <input id="telefono" type="text" class="form-control">
        <label>Nombre Privada</label>
        <input id="nombre_privada" type="text" class="form-control">
        <label>Rol</label>
        <select id="select-rol" class="form-control">
          <option id="1" value="1">Administrador</option>
          <option id="2" value="2">Usuario</option>
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