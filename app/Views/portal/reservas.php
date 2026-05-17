<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis Reservas – Residentia</title>
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/plugins/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <style>
    body { background: #f4f6f9; }
    .nav-portal { background: #fff; box-shadow: 0 2px 6px rgba(0,0,0,.1); }
    .card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,.07); }
    .reserva-item { border-left: 4px solid #1a73e8; background:#fff; border-radius:8px; padding:1rem 1.25rem; margin-bottom:.75rem; box-shadow:0 1px 4px rgba(0,0,0,.06); }
    .reserva-item.pasada { border-color: #adb5bd; opacity: .7; }
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
    <!-- Formulario nueva reserva -->
    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="card-header border-0"><h6 class="font-weight-bold mb-0"><i class="fas fa-plus-circle mr-2 text-primary"></i>Nueva Reserva</h6></div>
        <div class="card-body">
          <label class="small font-weight-bold">Área común *</label>
          <select id="id_area" class="form-control form-control-sm mb-3">
            <option value="">-- Selecciona --</option>
          </select>
          <label class="small font-weight-bold">Fecha *</label>
          <input id="fecha" type="date" class="form-control form-control-sm mb-3">
          <label class="small font-weight-bold">Hora inicio *</label>
          <input id="hora_inicio" type="time" class="form-control form-control-sm mb-3">
          <label class="small font-weight-bold">Hora fin *</label>
          <input id="hora_fin" type="time" class="form-control form-control-sm mb-3">
          <button id="btnReservar" class="btn btn-primary btn-block btn-sm">
            <i class="fas fa-calendar-check mr-1"></i>Reservar
          </button>
        </div>
      </div>
    </div>

    <!-- Lista de reservas -->
    <div class="col-md-8 mb-4">
      <div class="card">
        <div class="card-header border-0"><h6 class="font-weight-bold mb-0"><i class="fas fa-calendar-alt mr-2 text-primary"></i>Mis Reservas</h6></div>
        <div class="card-body" id="divReservas">
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
    // Set min date to today
    $('#fecha').attr('min', new Date().toISOString().split('T')[0]);

    cargarAreas();
    cargarReservas();

    $('#btnReservar').on('click', function () {
        const datos = {
            id_area: $('#id_area').val(),
            fecha: $('#fecha').val(),
            hora_inicio: $('#hora_inicio').val(),
            hora_fin: $('#hora_fin').val()
        };
        if (!datos.id_area || !datos.fecha || !datos.hora_inicio || !datos.hora_fin) {
            return Swal.fire('Campos requeridos', 'Completa todos los campos.', 'warning');
        }
        if (datos.hora_fin <= datos.hora_inicio) {
            return Swal.fire('Hora inválida', 'La hora de fin debe ser posterior al inicio.', 'warning');
        }
        $.post('/api/portal/reservas', datos, function (res) {
            if (res.ok) {
                $('#id_area').val('');
                $('#fecha, #hora_inicio, #hora_fin').val('');
                cargarReservas();
                Swal.fire({ icon: 'success', title: '¡Reserva creada!', timer: 1400, showConfirmButton: false });
            } else {
                Swal.fire('Error', res.msg || 'No se pudo crear la reserva.', 'error');
            }
        }, 'json');
    });
});

function cargarAreas() {
    $.getJSON('/api/areas', function (res) {
        let opts = '<option value="">-- Selecciona --</option>';
        (res.data || []).forEach(a => opts += `<option value="${a.id}">${esc(a.nombre)}</option>`);
        $('#id_area').html(opts);
    });
}

function cargarReservas() {
    $.getJSON('/api/portal/reservas', function (res) {
        const reservas = res.data || [];
        if (!reservas.length) {
            $('#divReservas').html('<p class="text-muted text-center py-3">No tienes reservas registradas.</p>');
            return;
        }
        const hoy = new Date().toISOString().split('T')[0];
        const html = reservas.map(r => {
            const pasada = r.fecha < hoy;
            return `
            <div class="reserva-item ${pasada ? 'pasada' : ''}">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <strong>${esc(r.nombre_area || 'Área')}</strong>
                        ${pasada ? '<span class="badge badge-secondary ml-2">Pasada</span>' : '<span class="badge badge-primary ml-2">Próxima</span>'}
                        <div class="text-muted small mt-1">
                            <i class="far fa-calendar mr-1"></i>${fmtFecha(r.fecha)}
                            &nbsp;&nbsp;
                            <i class="far fa-clock mr-1"></i>${r.hora_inicio} – ${r.hora_fin}
                        </div>
                    </div>
                </div>
            </div>`;
        }).join('');
        $('#divReservas').html(html);
    });
}

function esc(s) { return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }
function fmtFecha(s) {
    if (!s) return '-';
    const [y,m,d] = s.split('-');
    return `${d}/${m}/${y}`;
}
</script>
</body>
</html>
