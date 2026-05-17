<?php require_once __DIR__ . '/../layout/top.php'; ?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"><h1>Residentes</h1></div>
      <div class="col-sm-6"><ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
        <li class="breadcrumb-item active">Residentes</li>
      </ol></div>
    </div>
  </div>
</section>

<section class="content"><div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h5 class="card-title m-0">Listado de Residentes</h5>
      <div class="card-tools">
        <button id="btnAgregar" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Nuevo residente</button>
      </div>
    </div>
    <div class="card-body"><div id="divTabla"></div></div>
  </div>
</div></section>

<!-- Modal Nuevo/Editar -->
<div class="modal fade" id="modal-residente">
  <div class="modal-dialog modal-lg"><div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="modalTitulo">Nuevo Residente</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <input type="hidden" id="id_residente">
      <div class="row">
        <div class="col-md-4">
          <label>Nombre *</label>
          <input id="nombre" type="text" class="form-control mb-2" placeholder="Nombre">
        </div>
        <div class="col-md-4">
          <label>Apellido Paterno *</label>
          <input id="apP_Residente" type="text" class="form-control mb-2">
        </div>
        <div class="col-md-4">
          <label>Apellido Materno</label>
          <input id="apM_Residente" type="text" class="form-control mb-2">
        </div>
        <div class="col-md-4">
          <label>Teléfono</label>
          <input id="telefono" type="text" class="form-control mb-2">
        </div>
        <div class="col-md-4">
          <label>Correo</label>
          <input id="correo" type="email" class="form-control mb-2">
        </div>
        <div class="col-md-4">
          <label>Unidad</label>
          <select id="id_unidad" class="form-control mb-2">
            <option value="0">-- Sin asignar --</option>
          </select>
        </div>
        <div class="col-md-4" id="colPass">
          <label>Contraseña (acceso portal) *</label>
          <input id="password" type="password" class="form-control mb-2">
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button id="btnGuardar" type="button" class="btn btn-primary">Guardar</button>
    </div>
  </div></div>
</div>

<script src="/assets/js/cResidentes.js"></script>
<?php require_once __DIR__ . '/../layout/bottom.php'; ?>
