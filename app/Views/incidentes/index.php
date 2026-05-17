<?php require_once __DIR__ . '/../layout/top.php'; ?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"><h1>Incidentes</h1></div>
      <div class="col-sm-6"><ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
        <li class="breadcrumb-item active">Incidentes</li>
      </ol></div>
    </div>
  </div>
</section>

<section class="content"><div class="container-fluid">
  <div class="card card-danger card-outline">
    <div class="card-header">
      <h5 class="card-title m-0">Gestión de Incidentes</h5>
      <div class="card-tools">
        <button id="btnAgregar" class="btn btn-danger btn-sm"><i class="fas fa-plus"></i> Nuevo incidente</button>
      </div>
    </div>
    <div class="card-body"><div id="divTabla"></div></div>
  </div>
</div></section>

<div class="modal fade" id="modal-incidente">
  <div class="modal-dialog modal-lg"><div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Nuevo Incidente</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <label>Unidad</label>
          <select id="id_unidad" class="form-control mb-2"><option value="0">-- General --</option></select>
        </div>
        <div class="col-md-6">
          <label>Prioridad</label>
          <select id="prioridad" class="form-control mb-2">
            <option value="baja">Baja</option>
            <option value="media" selected>Media</option>
            <option value="alta">Alta</option>
          </select>
        </div>
        <div class="col-12">
          <label>Título *</label>
          <input id="titulo" type="text" class="form-control mb-2" placeholder="Resumen del incidente">
        </div>
        <div class="col-12">
          <label>Descripción *</label>
          <textarea id="descripcion" class="form-control" rows="4" placeholder="Describe el problema con detalle..."></textarea>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button id="btnGuardar" type="button" class="btn btn-danger">Reportar</button>
    </div>
  </div></div>
</div>

<script src="/assets/js/cIncidentes.js"></script>
<?php require_once __DIR__ . '/../layout/bottom.php'; ?>
