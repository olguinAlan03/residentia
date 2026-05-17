let tablaIncidentes;

$(function () {
    cargarTabla();
    cargarUnidades();

    $('#btnAgregar').on('click', function () {
        $('#titulo, #descripcion').val('');
        $('#id_unidad').val('0');
        $('#prioridad').val('media');
        $('#modal-incidente').modal('show');
    });

    $('#btnGuardar').on('click', guardar);
});

function cargarTabla() {
    if (tablaIncidentes) tablaIncidentes.destroy();

    $.getJSON('/api/incidentes', function (res) {
        const filas = (res.data || []).map(i => `
            <tr>
                <td>${i.id}</td>
                <td>${escHtml(i.titulo)}</td>
                <td>${i.numero_unidad || '<span class="text-muted">General</span>'}</td>
                <td>${i.residente_nombre
                    ? `<small>${escHtml(i.residente_nombre)}</small>`
                    : '<span class="text-muted">—</span>'}</td>
                <td>${badgePrioridad(i.prioridad)}</td>
                <td>${badgeEstado(i.estado)}</td>
                <td>${formatFecha(i.fecha_reporte)}</td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-secondary" onclick="cambiarEstado(${i.id}, 'en_proceso')" title="En proceso"><i class="fas fa-spinner"></i></button>
                        <button class="btn btn-outline-success" onclick="cambiarEstado(${i.id}, 'resuelto')" title="Resuelto"><i class="fas fa-check"></i></button>
                        <button class="btn btn-outline-danger" onclick="cambiarEstado(${i.id}, 'cerrado')" title="Cerrado"><i class="fas fa-times"></i></button>
                    </div>
                </td>
            </tr>`).join('');

        $('#divTabla').html(`
            <table id="tblIncidentes" class="table table-bordered table-hover table-sm">
                <thead class="thead-light">
                    <tr><th>#</th><th>Título</th><th>Unidad</th><th>Residente</th><th>Prioridad</th><th>Estado</th><th>Fecha</th><th>Acciones</th></tr>
                </thead>
                <tbody>${filas || '<tr><td colspan="8" class="text-center text-muted">No hay incidentes registrados.</td></tr>'}</tbody>
            </table>`);

        tablaIncidentes = $('#tblIncidentes').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' },
            order: [[0, 'desc']]
        });
    });
}

function cargarUnidades() {
    $.getJSON('/api/unidades', function (res) {
        let opts = '<option value="0">-- General --</option>';
        (res.data || []).forEach(u => opts += `<option value="${u.id}">${u.numero}${u.torre ? ' - ' + u.torre : ''}</option>`);
        $('#id_unidad').html(opts);
    });
}

function guardar() {
    const datos = {
        titulo: $('#titulo').val().trim(),
        descripcion: $('#descripcion').val().trim(),
        id_unidad: $('#id_unidad').val(),
        prioridad: $('#prioridad').val()
    };

    if (!datos.titulo || !datos.descripcion) {
        return Swal.fire('Campos requeridos', 'Título y descripción son obligatorios.', 'warning');
    }

    $.post('/api/incidentes', datos, function (res) {
        if (res.ok) {
            $('#modal-incidente').modal('hide');
            cargarTabla();
            Swal.fire({ icon: 'success', title: 'Incidente reportado', timer: 1400, showConfirmButton: false });
        } else {
            Swal.fire('Error', res.msg || 'No se pudo guardar.', 'error');
        }
    }, 'json');
}

function cambiarEstado(id, estado) {
    const etiquetas = { en_proceso: 'En proceso', resuelto: 'Resuelto', cerrado: 'Cerrado' };
    Swal.fire({
        title: `¿Marcar como "${etiquetas[estado]}"?`,
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Confirmar'
    }).then(r => {
        if (!r.isConfirmed) return;
        $.post('/api/incidentes/estado', { id, estado }, function (res) {
            if (res.ok) {
                cargarTabla();
                Swal.fire({ icon: 'success', title: 'Estado actualizado', timer: 1200, showConfirmButton: false });
            } else {
                Swal.fire('Error', res.msg || 'No se pudo actualizar.', 'error');
            }
        }, 'json');
    });
}

function badgePrioridad(p) {
    const map = { baja: 'badge-info', media: 'badge-warning', alta: 'badge-danger' };
    return `<span class="badge ${map[p] || 'badge-secondary'}">${p}</span>`;
}

function badgeEstado(e) {
    const map = { abierto: 'badge-danger', en_proceso: 'badge-warning', resuelto: 'badge-success', cerrado: 'badge-secondary' };
    const labels = { abierto: 'Abierto', en_proceso: 'En proceso', resuelto: 'Resuelto', cerrado: 'Cerrado' };
    return `<span class="badge ${map[e] || 'badge-secondary'}">${labels[e] || e}</span>`;
}

function escHtml(str) {
    return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

function formatFecha(str) {
    if (!str) return '-';
    const d = new Date(str);
    return d.toLocaleDateString('es-MX', { year:'numeric', month:'short', day:'numeric' });
}
