let tablaUnidades;

$(function () {
    cargarTabla();

    $('#btnAgregar').on('click', function () {
        $('#numero, #torre').val('');
        $('#piso').val('0');
        $('#tipo').val('departamento');
        $('#modal-unidad').modal('show');
    });

    $('#btnGuardar').on('click', guardar);
});

function cargarTabla() {
    if (tablaUnidades) tablaUnidades.destroy();

    $.getJSON('/api/unidades', function (res) {
        const filas = (res.data || []).map(u => `
            <tr>
                <td>${u.id}</td>
                <td><strong>${u.numero}</strong></td>
                <td>${u.torre || '-'}</td>
                <td>${u.piso ?? '-'}</td>
                <td><span class="badge badge-secondary">${u.tipo}</span></td>
                <td>${u.residente_nombre ? u.residente_nombre : '<span class="text-muted">Vacía</span>'}</td>
                <td>
                    <button class="btn btn-xs btn-danger" onclick="eliminar(${u.id})"><i class="fas fa-trash"></i></button>
                </td>
            </tr>`).join('');

        $('#divTabla').html(`
            <table id="tblUnidades" class="table table-bordered table-hover table-sm">
                <thead class="thead-light">
                    <tr><th>#</th><th>Número</th><th>Torre</th><th>Piso</th><th>Tipo</th><th>Residente</th><th>Acciones</th></tr>
                </thead>
                <tbody>${filas}</tbody>
            </table>`);

        tablaUnidades = $('#tblUnidades').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' },
            order: [[1, 'asc']]
        });
    });
}

function guardar() {
    const datos = {
        numero: $('#numero').val().trim(),
        torre: $('#torre').val().trim(),
        piso: $('#piso').val(),
        tipo: $('#tipo').val()
    };

    if (!datos.numero) {
        return Swal.fire('Campo requerido', 'El número o identificador es obligatorio.', 'warning');
    }

    $.post('/api/unidades', datos, function (res) {
        if (res.ok) {
            $('#modal-unidad').modal('hide');
            cargarTabla();
            Swal.fire({ icon: 'success', title: 'Unidad creada', timer: 1500, showConfirmButton: false });
        } else {
            Swal.fire('Error', res.msg || 'No se pudo crear la unidad.', 'error');
        }
    }, 'json');
}

function eliminar(id) {
    Swal.fire({
        title: '¿Eliminar unidad?',
        text: 'Se desvinculará cualquier residente asociado.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, eliminar'
    }).then(r => {
        if (!r.isConfirmed) return;
        $.post('/api/unidades/delete', { id }, function (res) {
            if (res.ok) {
                cargarTabla();
                Swal.fire({ icon: 'success', title: 'Eliminada', timer: 1200, showConfirmButton: false });
            } else {
                Swal.fire('Error', res.msg || 'No se pudo eliminar.', 'error');
            }
        }, 'json');
    });
}
