<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis Incidentes – Residentia</title>
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/plugins/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <style>
    body { background: #f4f6f9; }
    .nav-portal { background: #fff; box-shadow: 0 2px 6px rgba(0,0,0,.1); }
    .card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,.07); }
    .incidente-item { background:#fff; border-radius:8px; padding:1rem 1.25rem; margin-bottom:.75rem; box-shadow:0 1px 4px rgba(0,0,0,.06); border-left: 4px solid #dc3545; }
    .incidente-item.resuelto { border-color: #28a745; }
    .incidente-item.en_proceso { border-color: #ffc107; }
    .incidente-item.cerrado { border-color: #adb5bd; opacity: .75; }
  </style>
</head>
<body>

<nav class="navbar nav-portal navbar-expand-lg mb-4">
  <div class="container">
    <a class="navbar-brand font-weight-bold text-primary" href="/portal"><i class="fas fa-building mr-2"></i>Residentia</a>
    <div class="ml-auto">
      <a href="/portal" class="btn btn-light btn-sm mr-2"><i class="fas fa-arrow-left mr-1"></i>Volver</a>
      <a href="/logout" class="btn btn-outline-secondary btn-sm"><i class="fas fa-sign-out-alt"></i></a>
    </div>
  </div>
</nav>

<div class="container">
  <div class="row">
    <!-- Formulario nuevo incidente -->
    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="card-header border-0"><h6 class="font-weight-bold mb-0"><i class="fas fa-flag mr-2 text-danger"></i>Reportar Incidente</h6></div>
        <div class="card-body">
          <label class="small font-weight-bold">Título *</label>
          <input id="titulo" type="text" class="form-control form-control-sm mb-3" placeholder="Resumen breve del problema">
          <label class="small font-weight-bold">Prioridad</label>
          <select id="prioridad" class="form-control form-control-sm mb-3">
            <option value="baja">Baja</option>
            <option value="media" selected>Media</option>
            <option value="alta">Alta</option>
          </select>
          <label class="small font-weight-bold">Descripción *</label>
          <textarea id="descripcion" class="form-control form-control-sm mb-3" rows="4" placeholder="Describe el problema con detalle..."></textarea>
          <button id="btnReportar" class="btn btn-danger btn-block btn-sm">
            <i class="fas fa-paper-plane mr-1"></i>Enviar Reporte
          </button>
        </div>
      </div>
    </div>

    <!-- Lista de incidentes -->
    <div class="col-md-8 mb-4">
      <div class="card">
        <div class="card-header border-0"><h6 class="font-weight-bold mb-0"><i class="fas fa-list mr-2 text-danger"></i>Historial de Incidentes</h6></div>
        <div class="card-body" id="divIncidentes">
          <div class="text-center text-muted py-3">Cargando...</div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="/plugins/jquery/jquery.min.js"></script>
<script src="/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script>
$(function () {
    cargarIncidentes();

    $('#btnReportar').on('click', function () {
        const datos = {
            titulo: $('#titulo').val().trim(),
            descripcion: $('#descripcion').val().trim(),
            prioridad: $('#prioridad').val()
        };
        if (!datos.titulo || !datos.descripcion) {
            return Swal.fire('Campos requeridos', 'Título y descripción son obligatorios.', 'warning');
        }
        $.post('/api/portal/incidentes', datos, function (res) {
            if (res.ok) {
                $('#titulo, #descripcion').val('');
                $('#prioridad').val('media');
                cargarIncidentes();
                Swal.fire({ icon: 'success', title: 'Reporte enviado', text: 'La administración revisará tu incidente.', timer: 2000, showConfirmButton: false });
            } else {
                Swal.fire('Error', res.msg || 'No se pudo enviar el reporte.', 'error');
            }
        }, 'json');
    });
});

function cargarIncidentes() {
    $.getJSON('/api/portal/incidentes', function (res) {
        const inc = res.data || [];
        if (!inc.length) {
            $('#divIncidentes').html('<p class="text-muted text-center py-3">No tienes incidentes reportados.</p>');
            return;
        }
        const html = inc.map(i => `
            <div class="incidente-item ${i.estado}">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <strong>${esc(i.titulo)}</strong>
                        &nbsp;${badgePrioridad(i.prioridad)}
                        &nbsp;${badgeEstado(i.estado)}
                        <div class="text-muted small mt-1">${esc(i.descripcion)}</div>
                        <small class="text-muted"><i class="far fa-clock mr-1"></i>${fmt(i.fecha_reporte)}</small>
                    </div>
                </div>
            </div>`).join('');
        $('#divIncidentes').html(html);
    });
}

function esc(s) { return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }
function fmt(s) {
    if (!s) return '-';
    return new Date(s).toLocaleDateString('es-MX', { year:'numeric', month:'short', day:'numeric', hour:'2-digit', minute:'2-digit' });
}
function badgePrioridad(p) {
    const m = { baja:'info', media:'warning', alta:'danger' };
    return `<span class="badge badge-${m[p]||'secondary'}">${p}</span>`;
}
function badgeEstado(e) {
    const m = { abierto:'danger', en_proceso:'warning', resuelto:'success', cerrado:'secondary' };
    const l = { abierto:'Abierto', en_proceso:'En proceso', resuelto:'Resuelto', cerrado:'Cerrado' };
    return `<span class="badge badge-${m[e]||'secondary'}">${l[e]||e}</span>`;
}
</script>
</body>
</html>
