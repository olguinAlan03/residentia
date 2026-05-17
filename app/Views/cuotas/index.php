<?php require_once __DIR__ . '/../layout/top.php'; ?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"><h1>Cuotas de Mantenimiento</h1></div>
      <div class="col-sm-6"><ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
        <li class="breadcrumb-item active">Cuotas</li>
      </ol></div>
    </div>
  </div>
</section>

<section class="content"><div class="container-fluid">
  <div class="card card-warning card-outline">
    <div class="card-header">
      <h5 class="card-title m-0">Gestión de Cuotas</h5>
      <div class="card-tools">
        <button id="btnAgregar" class="btn btn-warning btn-sm text-white"><i class="fas fa-plus"></i> Nueva cuota</button>
      </div>
    </div>
    <div class="card-body"><div id="divTabla"></div></div>
  </div>
</div></section>

<div class="modal fade" id="modal-cuota">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Nueva Cuota</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <label>Unidad *</label>
      <select id="id_unidad" class="form-control mb-2"><option value="">-- Selecciona --</option></select>
      <label>Concepto *</label>
      <input id="concepto" type="text" class="form-control mb-2" placeholder="Ej: Mantenimiento Mayo 2026">
      <label>Monto ($) *</label>
      <input id="monto" type="number" step="0.01" class="form-control mb-2" placeholder="850.00">
      <label>Fecha de vencimiento *</label>
      <input id="fecha_vencimiento" type="date" class="form-control mb-2">
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button id="btnGuardar" type="button" class="btn btn-warning text-white">Guardar</button>
    </div>
  </div></div>
</div>

<script src="/assets/js/cCuotas.js"></script>
<?php require_once __DIR__ . '/../layout/bottom.php'; ?>
