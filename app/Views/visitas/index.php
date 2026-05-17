<?php require_once __DIR__ . '/../layout/top.php'; ?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"><h1>Registro de Visitas</h1></div>
      <div class="col-sm-6"><ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
        <li class="breadcrumb-item active">Visitas</li>
      </ol></div>
    </div>
  </div>
</section>

<section class="content"><div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
      <div class="card card-success card-outline">
        <div class="card-header"><h5 class="card-title m-0"><i class="fas fa-user-plus mr-1"></i>Nueva visita</h5></div>
        <div class="card-body">
          <label>Nombre del visitante *</label>
          <input id="nombre_visitante" type="text" class="form-control mb-2">
          <label>Unidad a visitar *</label>
          <select id="id_unidad" class="form-control mb-2">
            <option value="">-- Selecciona --</option>
          </select>
          <label>Motivo</label>
          <input id="motivo" type="text" class="form-control mb-3" placeholder="Ej: Visita familiar">
          <button id="btnRegistrar" class="btn btn-success btn-block">
            <i class="fas fa-sign-in-alt mr-1"></i> Registrar entrada
          </button>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card card-outline card-primary">
        <div class="card-header"><h5 class="card-title m-0">Visitas del día</h5></div>
        <div class="card-body p-0"><div id="divTabla"></div></div>
      </div>
    </div>
  </div>
</div></section>

<script src="/assets/js/cVisitas.js"></script>
<?php require_once __DIR__ . '/../layout/bottom.php'; ?>
