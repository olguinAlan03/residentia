<?php require_once __DIR__ . '/../layout/top.php'; ?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"><h1>Dashboard</h1></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Inicio</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">

    <!-- Stats Row -->
    <div class="row">
      <div class="col-lg-2 col-6">
        <div class="small-box bg-info">
          <div class="inner"><h3 id="stat-residentes"><?= $stats['residentes'] ?></h3><p>Residentes</p></div>
          <div class="icon"><i class="fas fa-users"></i></div>
          <a href="/residentes" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-2 col-6">
        <div class="small-box bg-secondary">
          <div class="inner"><h3 id="stat-unidades"><?= $stats['unidades'] ?></h3><p>Unidades</p></div>
          <div class="icon"><i class="fas fa-building"></i></div>
          <a href="/unidades" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-2 col-6">
        <div class="small-box bg-success">
          <div class="inner"><h3 id="stat-vehiculos"><?= $stats['vehiculos'] ?></h3><p>Vehículos</p></div>
          <div class="icon"><i class="fas fa-car"></i></div>
          <a href="/vehiculos" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-2 col-6">
        <div class="small-box bg-primary">
          <div class="inner"><h3 id="stat-visitas"><?= $stats['visitas_hoy'] ?></h3><p>Visitas hoy</p></div>
          <div class="icon"><i class="fas fa-user-check"></i></div>
          <a href="/visitas" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-2 col-6">
        <div class="small-box bg-warning">
          <div class="inner"><h3 id="stat-cuotas"><?= $stats['cuotas_pend'] ?></h3><p>Cuotas pendientes</p></div>
          <div class="icon"><i class="fas fa-dollar-sign"></i></div>
          <a href="/cuotas" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-2 col-6">
        <div class="small-box bg-danger">
          <div class="inner"><h3 id="stat-incidentes"><?= $stats['incidentes'] ?></h3><p>Incidentes abiertos</p></div>
          <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
          <a href="/incidentes" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <!-- Quick Access -->
    <div class="row mt-2">
      <div class="col-md-6">
        <div class="card card-outline card-primary">
          <div class="card-header"><h5 class="card-title m-0"><i class="fas fa-bolt mr-2"></i>Acceso rápido</h5></div>
          <div class="card-body">
            <div class="row">
              <div class="col-6 mb-2"><a href="/visitas" class="btn btn-block btn-outline-primary"><i class="fas fa-user-plus mr-1"></i>Registrar visita</a></div>
              <div class="col-6 mb-2"><a href="/reservas" class="btn btn-block btn-outline-success"><i class="fas fa-calendar-plus mr-1"></i>Nueva reserva</a></div>
              <div class="col-6 mb-2"><a href="/cuotas" class="btn btn-block btn-outline-warning"><i class="fas fa-file-invoice-dollar mr-1"></i>Gestionar cuotas</a></div>
              <div class="col-6 mb-2"><a href="/avisos" class="btn btn-block btn-outline-info"><i class="fas fa-bullhorn mr-1"></i>Publicar aviso</a></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-outline card-danger">
          <div class="card-header"><h5 class="card-title m-0"><i class="fas fa-exclamation-triangle mr-2"></i>Incidentes recientes</h5></div>
          <div class="card-body p-0">
            <table class="table table-sm table-hover mb-0">
              <thead><tr><th>Título</th><th>Unidad</th><th>Prioridad</th><th>Estado</th></tr></thead>
              <tbody id="tbodyIncidentes"><tr><td colspan="3" class="text-center text-muted p-3">Cargando...</td></tr></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<script>
$(document).ready(function () {
  fetch('/api/incidentes')
    .then(r => r.json())
    .then(data => {
      const items = (data.data || []).slice(0, 5);
      if (!items.length) {
        $('#tbodyIncidentes').html('<tr><td colspan="4" class="text-center text-muted">Sin incidentes</td></tr>');
        return;
      }
      const priBadge = { alta: 'danger', media: 'warning', baja: 'info' };
      const estBadge = { abierto: 'danger', en_proceso: 'warning', resuelto: 'success', cerrado: 'secondary' };
      const estLabel = { abierto: 'Abierto', en_proceso: 'En proceso', resuelto: 'Resuelto', cerrado: 'Cerrado' };
      $('#tbodyIncidentes').html(items.map(i => `
        <tr>
          <td>${i.titulo}</td>
          <td>${i.numero_unidad ? i.numero_unidad : '<span class="text-muted">—</span>'}</td>
          <td><span class="badge badge-${priBadge[i.prioridad] || 'secondary'}">${i.prioridad}</span></td>
          <td><span class="badge badge-${estBadge[i.estado] || 'secondary'}">${estLabel[i.estado] || i.estado}</span></td>
        </tr>`).join(''));
    });
});
</script>

<?php require_once __DIR__ . '/../layout/bottom.php'; ?>
