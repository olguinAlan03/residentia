<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portal del Residente – Residentia</title>
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/plugins/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <style>
    body { background: #f4f6f9; font-family: 'Source Sans Pro', sans-serif; }
    .portal-header { background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%); color: #fff; padding: 2rem 0; }
    .stat-card { border-radius: 12px; border: none; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
    .quick-btn { border-radius: 10px; font-size: .95rem; }
    .aviso-item { border-left: 4px solid #1a73e8; background: #fff; border-radius: 8px; padding: 1rem 1.25rem; margin-bottom: .75rem; box-shadow: 0 1px 4px rgba(0,0,0,.06); }
    .incidente-row td { vertical-align: middle; }
    .nav-portal { background: #fff; box-shadow: 0 2px 6px rgba(0,0,0,.1); }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar nav-portal navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand font-weight-bold text-primary" href="/portal">
      <i class="fas fa-building mr-2"></i>Residentia
    </a>
    <div class="ml-auto d-flex align-items-center">
      <span class="text-muted mr-3 d-none d-md-inline">
        <i class="fas fa-user-circle mr-1"></i><?= htmlspecialchars($_SESSION['nombre'] ?? 'Residente') ?>
      </span>
      <a href="/portal/reservas" class="btn btn-outline-primary btn-sm mr-2">
        <i class="fas fa-calendar-alt mr-1"></i>Mis Reservas
      </a>
      <a href="/portal/incidentes" class="btn btn-outline-danger btn-sm mr-2">
        <i class="fas fa-exclamation-triangle mr-1"></i>Mis Incidentes
      </a>
      <a href="/logout" class="btn btn-light btn-sm">
        <i class="fas fa-sign-out-alt"></i>
      </a>
    </div>
  </div>
</nav>

<!-- Header -->
<div class="portal-header">
  <div class="container">
    <h2 class="mb-1"><i class="fas fa-home mr-2"></i>Bienvenido, <?= htmlspecialchars($_SESSION['nombre'] ?? 'Residente') ?></h2>
    <p class="mb-0 opacity-75">Panel del Residente</p>
  </div>
</div>

<div class="container mt-4">

  <!-- Stat cards -->
  <div class="row mb-4" id="statCards">
    <div class="col-6 col-md-3 mb-3">
      <div class="card stat-card text-center p-3">
        <div class="text-primary" style="font-size:2rem"><i class="fas fa-calendar-check"></i></div>
        <h4 class="mb-0" id="cntReservas">–</h4>
        <small class="text-muted">Mis Reservas</small>
      </div>
    </div>
    <div class="col-6 col-md-3 mb-3">
      <div class="card stat-card text-center p-3">
        <div class="text-danger" style="font-size:2rem"><i class="fas fa-exclamation-circle"></i></div>
        <h4 class="mb-0" id="cntIncidentes">–</h4>
        <small class="text-muted">Mis Incidentes</small>
      </div>
    </div>
    <div class="col-6 col-md-3 mb-3">
      <div class="card stat-card text-center p-3">
        <div class="text-warning" style="font-size:2rem"><i class="fas fa-file-invoice-dollar"></i></div>
        <h4 class="mb-0" id="cntCuotas">–</h4>
        <small class="text-muted">Cuotas pendientes</small>
      </div>
    </div>
    <div class="col-6 col-md-3 mb-3">
      <div class="card stat-card text-center p-3">
        <div class="text-success" style="font-size:2rem"><i class="fas fa-bullhorn"></i></div>
        <h4 class="mb-0" id="cntAvisos">–</h4>
        <small class="text-muted">Avisos activos</small>
      </div>
    </div>
  </div>

  <!-- Quick actions -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card stat-card">
        <div class="card-body">
          <h6 class="text-muted text-uppercase mb-3" style="font-size:.75rem;letter-spacing:.05em">Acciones rápidas</h6>
          <div class="d-flex flex-wrap" style="gap:.5rem">
            <a href="/portal/reservas" class="btn btn-primary quick-btn"><i class="fas fa-plus mr-1"></i>Nueva Reserva</a>
            <a href="/portal/incidentes" class="btn btn-danger quick-btn"><i class="fas fa-flag mr-1"></i>Reportar Incidente</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Avisos -->
    <div class="col-md-7 mb-4">
      <div class="card stat-card">
        <div class="card-header border-0 pb-0">
          <h6 class="font-weight-bold mb-0"><i class="fas fa-bullhorn mr-2 text-primary"></i>Avisos y Comunicados</h6>
        </div>
        <div class="card-body" id="divAvisos">
          <div class="text-center text-muted py-3">Cargando...</div>
        </div>
      </div>
    </div>

    <!-- Mis incidentes recientes -->
    <div class="col-md-5 mb-4">
      <div class="card stat-card">
        <div class="card-header border-0 pb-0">
          <h6 class="font-weight-bold mb-0"><i class="fas fa-exclamation-triangle mr-2 text-danger"></i>Mis Incidentes</h6>
        </div>
        <div class="card-body p-0">
          <table class="table table-sm mb-0" id="tblMisIncidentes">
            <tbody><tr><td class="text-center text-muted py-3">Cargando...</td></tr></tbody>
          </table>
        </div>
        <div class="card-footer bg-transparent border-0 text-right">
          <a href="/portal/incidentes" class="btn btn-sm btn-outline-danger">Ver todos</a>
        </div>
      </div>
    </div>
  </div>

</div>

<footer class="text-center text-muted py-4 mt-2" style="font-size:.85rem">
  &copy; <?= date('Y') ?> Residentia · Sistema de Gestión de Condominios
</footer>

<script src="/plugins/jquery/jquery.min.js"></script>
<script src="/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script>
$(function () {
    // Avisos
    $.getJSON('/api/avisos/activos', function (res) {
        const avisos = res.data || [];
        $('#cntAvisos').text(avisos.length);
        if (!avisos.length) {
            $('#divAvisos').html('<p class="text-muted mb-0">No hay comunicados activos.</p>');
            return;
        }
        $('#divAvisos').html(avisos.map(a => `
            <div class="aviso-item">
                <strong>${esc(a.titulo)}</strong>
                <div class="text-muted small mt-1">${esc(a.contenido)}</div>
                <small class="text-muted">${fmt(a.fecha_publicacion)}</small>
            </div>`).join(''));
    });

    // Mis incidentes
    $.getJSON('/api/portal/incidentes', function (res) {
        const inc = res.data || [];
        $('#cntIncidentes').text(inc.length);
        const rows = inc.slice(0, 5).map(i => `
            <tr class="incidente-row">
                <td class="pl-3">${esc(i.titulo)}</td>
                <td>${badge(i.estado)}</td>
            </tr>`).join('') || '<tr><td class="text-center text-muted py-3">Sin incidentes.</td></tr>';
        $('#tblMisIncidentes tbody').html(rows);
    });

    // Reservas count
    $.getJSON('/api/portal/reservas', function (res) {
        $('#cntReservas').text((res.data || []).length);
    });

    // Cuotas pendientes – not exposed per-residente yet, show dash
    $('#cntCuotas').text('–');
});

function esc(s) { return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }
function fmt(s) {
    if (!s) return '';
    return new Date(s).toLocaleDateString('es-MX', { year:'numeric', month:'short', day:'numeric' });
}
function badge(e) {
    const map = { abierto:'danger', en_proceso:'warning', resuelto:'success', cerrado:'secondary' };
    const lbl = { abierto:'Abierto', en_proceso:'En proceso', resuelto:'Resuelto', cerrado:'Cerrado' };
    return `<span class="badge badge-${map[e]||'secondary'}">${lbl[e]||e}</span>`;
}
</script>
</body>
</html>
