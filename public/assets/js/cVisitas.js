let tablaVisitas;

$(function () {
    cargarUnidades();
    cargarTabla();

    $('#btnRegistrar').on('click', function () {
        const nombre = $('#nombre_visitante').val().trim();
        const id_unidad = $('#id_unidad').val();
        const motivo = $('#motivo').val().trim();

        if (!nombre || !id_unidad) {
            return Swal.fire('Campos requeridos', 'Nombre del visitante y unidad son obligatorios.', 'warning');
        }

        $.post('/api/visitas', { nombre_visitante: nombre, id_unidad, motivo }, function (res) {
            if (res.ok) {
                $('#nombre_visitante').val('');
                $('#id_unidad').val('');
                $('#motivo').val('');
                cargarTabla();
                Swal.fire({ icon: 'success', title: 'Entrada registrada', timer: 1400, showConfirmButton: false });
            } else {
                Swal.fire('Error', res.msg || 'No se pudo registrar.', 'error');
            }
        }, 'json');
    });
});

function cargarUnidades() {
    $.getJSON('/api/unidades', function (res) {
        let opts = '<option value="">-- Selecciona --</option>';
        (res.data || []).forEach(u => opts += `<option value="${u.id}">${u.numero}${u.torre ? ' - ' + u.torre : ''}</option>`);
        $('#id_unidad').html(opts);
    });
}

function cargarTabla() {
    if (tablaVisitas) tablaVisitas.destroy();

    $.getJSON('/api/visitas', function (res) {
        const filas = (res.data || []).map(v => `
            <tr>
                <td>${v.id}</td>
                <td>${escHtml(v.nombre_visitante)}</td>
                <td>${v.numero_unidad || '-'}</td>
                <td>${escHtml(v.motivo || '-')}</td>
                <td>${formatHora(v.hora_entrada)}</td>
                <td>${v.hora_salida ? formatHora(v.hora_salida) : '<span class="badge badge-warning">En sitio</span>'}</td>
                <td>${!v.hora_salida
                    ? `<button class="btn btn-xs btn-success" onclick="registrarSalida(${v.id})"><i class="fas fa-sign-out-alt mr-1"></i>Salida</button>`
                    : '<span class="text-muted">—</span>'
                }</td>
            </tr>`).join('');

        $('#divTabla').html(`
            <table id="tblVisitas" class="table table-sm table-hover">
                <thead class="thead-light">
                    <tr><th>#</th><th>Visitante</th><th>Unidad</th><th>Motivo</th><th>Entrada</th><th>Salida</th><th></th></tr>
                </thead>
                <tbody>${filas || '<tr><td colspan="7" class="text-center text-muted">Sin visitas hoy.</td></tr>'}</tbody>
            </table>`);

        tablaVisitas = $('#tblVisitas').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' },
            order: [[0, 'desc']],
            pageLength: 25
        });
    });
}

function registrarSalida(id) {
    $.post('/api/visitas/salida', { id }, function (res) {
        if (res.ok) {
            cargarTabla();
            Swal.fire({ icon: 'success', title: 'Salida registrada', timer: 1200, showConfirmButton: false });
        } else {
            Swal.fire('Error', res.msg || 'No se pudo registrar la salida.', 'error');
        }
    }, 'json');
}

function escHtml(str) {
    return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

function formatHora(str) {
    if (!str) return '-';
    const d = new Date(str);
    return d.toLocaleTimeString('es-MX', { hour: '2-digit', minute: '2-digit' });
}
