let tablaCuotas;

$(function () {
    cargarTabla();

    $('#btnAgregar').on('click', function () {
        $('#concepto, #monto, #fecha_vencimiento').val('');
        $('#id_unidad').val('');
        cargarUnidades();
        $('#modal-cuota').modal('show');
    });

    $('#btnGuardar').on('click', guardar);
});

function cargarTabla() {
    if (tablaCuotas) tablaCuotas.destroy();

    $.getJSON('/api/cuotas', function (res) {
        const filas = (res.data || []).map(c => {
            const pagada  = c.estado === 'pagada';
            const vencida = !pagada && new Date(c.fecha_vencimiento) < new Date();
            let estadoBadge;
            if (pagada)   estadoBadge = '<span class="badge badge-success">Pagada</span>';
            else if (vencida) estadoBadge = '<span class="badge badge-danger">Vencida</span>';
            else          estadoBadge = '<span class="badge badge-warning">Pendiente</span>';

            return `
            <tr>
                <td>${c.id}</td>
                <td>${c.numero_unidad || '-'}</td>
                <td>${escHtml(c.concepto)}</td>
                <td>$${parseFloat(c.monto).toFixed(2)}</td>
                <td>${formatFecha(c.fecha_vencimiento)}</td>
                <td>${estadoBadge}</td>
                <td>
                    ${!pagada ? `<button class="btn btn-xs btn-success mr-1" onclick="marcarPagada(${c.id})"><i class="fas fa-check"></i> Pagar</button>` : ''}
                    <button class="btn btn-xs btn-danger" onclick="eliminar(${c.id})"><i class="fas fa-trash"></i></button>
                </td>
            </tr>`;
        }).join('');

        $('#divTabla').html(`
            <table id="tblCuotas" class="table table-bordered table-hover table-sm">
                <thead class="thead-light">
                    <tr><th>#</th><th>Unidad</th><th>Concepto</th><th>Monto</th><th>Vencimiento</th><th>Estado</th><th>Acciones</th></tr>
                </thead>
                <tbody>${filas || '<tr><td colspan="7" class="text-center text-muted">No hay cuotas registradas.</td></tr>'}</tbody>
            </table>`);

        tablaCuotas = $('#tblCuotas').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' },
            order: [[0, 'desc']]
        });
    });
}

function cargarUnidades() {
    $.getJSON('/api/unidades', function (res) {
        let opts = '<option value="">-- Selecciona --</option>';
        (res.data || []).forEach(u => opts += `<option value="${u.id}">${u.numero}${u.torre ? ' - ' + u.torre : ''}</option>`);
        $('#id_unidad').html(opts);
    });
}

function guardar() {
    const datos = {
        id_unidad: $('#id_unidad').val(),
        concepto: $('#concepto').val().trim(),
        monto: $('#monto').val(),
        fecha_vencimiento: $('#fecha_vencimiento').val()
    };

    if (!datos.id_unidad || !datos.concepto || !datos.monto || !datos.fecha_vencimiento) {
        return Swal.fire('Campos requeridos', 'Todos los campos son obligatorios.', 'warning');
    }

    $.post('/api/cuotas', datos, function (res) {
        if (res.ok) {
            $('#modal-cuota').modal('hide');
            cargarTabla();
            Swal.fire({ icon: 'success', title: 'Cuota registrada', timer: 1400, showConfirmButton: false });
        } else {
            Swal.fire('Error', res.msg || 'No se pudo guardar.', 'error');
        }
    }, 'json');
}

function marcarPagada(id) {
    Swal.fire({
        title: '¿Marcar como pagada?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Confirmar pago'
    }).then(r => {
        if (!r.isConfirmed) return;
        $.post('/api/cuotas/pagar', { id }, function (res) {
            if (res.ok) {
                cargarTabla();
                Swal.fire({ icon: 'success', title: 'Pago registrado', timer: 1200, showConfirmButton: false });
            } else {
                Swal.fire('Error', res.msg || 'No se pudo actualizar.', 'error');
            }
        }, 'json');
    });
}

function eliminar(id) {
    Swal.fire({
        title: '¿Eliminar cuota?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Eliminar'
    }).then(r => {
        if (!r.isConfirmed) return;
        $.post('/api/cuotas/delete', { id }, function (res) {
            if (res.ok) {
                cargarTabla();
                Swal.fire({ icon: 'success', title: 'Eliminada', timer: 1200, showConfirmButton: false });
            } else {
                Swal.fire('Error', res.msg || 'No se pudo eliminar.', 'error');
            }
        }, 'json');
    });
}

function escHtml(str) {
    return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

function formatFecha(str) {
    if (!str) return '-';
    const [y, m, d] = str.split('-');
    return `${d}/${m}/${y}`;
}
