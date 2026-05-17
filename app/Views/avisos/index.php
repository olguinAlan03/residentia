<?php require_once __DIR__ . '/../layout/top.php'; ?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"><h1>Avisos y Comunicados</h1></div>
      <div class="col-sm-6"><ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
        <li class="breadcrumb-item active">Avisos</li>
      </ol></div>
    </div>
  </div>
</section>

<section class="content"><div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
      <div class="card card-primary card-outline">
        <div class="card-header"><h5 class="card-title m-0">Publicar aviso</h5></div>
        <div class="card-body">
          <label>Título *</label>
          <input id="titulo" type="text" class="form-control mb-2">
          <label>Contenido *</label>
          <textarea id="contenido" class="form-control mb-3" rows="5" placeholder="Escribe el comunicado..."></textarea>
          <button id="btnPublicar" class="btn btn-primary btn-block">
            <i class="fas fa-paper-plane mr-1"></i> Publicar
          </button>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card card-outline card-info">
        <div class="card-header"><h5 class="card-title m-0">Comunicados publicados</h5></div>
        <div class="card-body p-0" id="divAvisos">
          <div class="text-center p-4 text-muted">Cargando...</div>
        </div>
      </div>
    </div>
  </div>
</div></section>

<script src="/assets/js/cAvisos.js"></script>
<?php require_once __DIR__ . '/../layout/bottom.php'; ?>
