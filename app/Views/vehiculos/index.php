<?php require_once __DIR__ . '/../layout/top.php'; ?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"><h1>Vehículos</h1></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
          <li class="breadcrumb-item active">Vehículos</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="card-title m-0">REGISTRO DE VEHÍCULOS</h5>
        <div class="card-tools">
          <button id="agregar" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Agregar vehículo
          </button>
        </div>
      </div>
      <div class="card-body">
        <div id="divTablaVehiculo"></div>
      </div>
    </div>
  </div>
</section>

<!-- Modal: Registrar vehículo -->
<div class="modal fade" id="modal-registro">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Nuevo Vehículo</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <label>Propietario (Residente):</label>
        <select id="id_residente" class="form-control mb-2">
          <option value="">-- Sin asignar --</option>
        </select>
        <div class="row">
          <div class="col-6">
            <label>Marca:</label>
            <input id="marca" type="text" class="form-control mb-2">
          </div>
          <div class="col-6">
            <label>Modelo:</label>
            <input id="modelo" type="text" class="form-control mb-2">
          </div>
          <div class="col-6">
            <label>Color:</label>
            <input id="color" type="text" class="form-control mb-2">
          </div>
          <div class="col-6">
            <label>Matrícula:</label>
            <input id="n_matricula" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="guardar" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Agregar Tag -->
<div class="modal fade" id="modal-tag">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar Tag RFID</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <label>Número de Tag:</label>
        <input id="n_tag" type="text" class="form-control mb-2">
        <label>Fecha de Registro:</label>
        <input id="f_registro" type="date" class="form-control mb-2">
        <label>Fecha de Vencimiento:</label>
        <input id="f_vencimiento" type="date" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="guardarTag" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Consultar Tags -->
<div class="modal fade" id="modal-consulta-tag">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tags del Vehículo</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="divTablaTag"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="/assets/js/cTablaVehiculo.js"></script>

<?php require_once __DIR__ . '/../layout/bottom.php'; ?>
