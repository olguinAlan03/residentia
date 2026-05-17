<?php require_once __DIR__ . '/../layout/top.php'; ?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"><h1>Unidades</h1></div>
      <div class="col-sm-6"><ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
        <li class="breadcrumb-item active">Unidades</li>
      </ol></div>
    </div>
  </div>
</section>

<section class="content"><div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h5 class="card-title m-0">Unidades del Condominio</h5>
      <div class="card-tools">
        <button id="btnAgregar" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Nueva unidad</button>
      </div>
    </div>
    <div class="card-body"><div id="divTabla"></div></div>
  </div>
</div></section>

<div class="modal fade" id="modal-unidad">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Nueva Unidad</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <label>Número / Identificador *</label>
      <input id="numero" type="text" class="form-control mb-2" placeholder="Ej: 101, Casa-3">
      <label>Torre / Edificio</label>
      <input id="torre" type="text" class="form-control mb-2" placeholder="Ej: A, B, Norte">
      <label>Piso</label>
      <input id="piso" type="number" class="form-control mb-2" value="0" min="0">
      <label>Tipo</label>
      <select id="tipo" class="form-control mb-2">
        <option value="departamento">Departamento</option>
        <option value="casa">Casa</option>
        <option value="local">Local Comercial</option>
      </select>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button id="btnGuardar" type="button" class="btn btn-primary">Guardar</button>
    </div>
  </div></div>
</div>

<script src="/assets/js/cUnidades.js"></script>
<?php require_once __DIR__ . '/../layout/bottom.php'; ?>
