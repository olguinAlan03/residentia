let tablaResidentes;
let modoEdicion = false;
let idEditando = null;

$(function () {
    cargarTabla();

    $('#btnAgregar').on('click', function () {
        modoEdicion = false;
        idEditando = null;
        resetForm();
        $('.modal-title').text('Nuevo Residente');
        $('#modal-residente').modal('show');
    });

    $('#btnGuardar').on('click', guardar);
});

function cargarTabla() {
    if (tablaResidentes) tablaResidentes.destroy();

    $.getJSON('/api/residentes', function (res) {
        const filas = (res.data || []).map(r => `
            <tr>
                <td>${r.id}</td>
                <td>${r.apP_Residente} ${r.apM_Residente}</td>
                <td>${r.nombre}</td>
                <td>${r.correo}</td>
                <td>${r.telefono || '-'}</td>
                <td>${r.numero_unidad || '<span class="text-muted">Sin unidad</span>'}</td>
                <td>
                    <button class="btn btn-xs btn-info mr-1" onclick="editar(${r.id})"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-xs btn-danger" onclick="eliminar(${r.id})"><i class="fas fa-trash"></i></button>
                </td>
            </tr>`).join('');

        $('#divTabla').html(`
            <table id="tblResidentes" class="table table-bordered table-hover table-sm">
                <thead class="thead-light">
                    <tr><th>#</th><th>Apellidos</th><th>Nombre</th><th>Correo</th><th>Teléfono</th><th>Unidad</th><th>Acciones</th></tr>
                </thead>
                <tbody>${filas}</tbody>
            </table>`);

        tablaResidentes = $('#tblResidentes').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' },
            order: [[0, 'desc']]
        });
    });
}

function resetForm() {
    ['#nombre', '#apP_Residente', '#apM_Residente', '#correo', '#telefono', '#id_unidad', '#password'].forEach(id => $(id).val(''));
    cargarUnidades();
}

function cargarUnidades() {
    $.getJSON('/api/unidades', function (res) {
        let opts = '<option value="">-- Sin asignar --</option>';
        (res.data || []).forEach(u => opts += `<option value="${u.id}">${u.numero} ${u.torre ? '- ' + u.torre : ''}</option>`);
        $('#id_unidad').html(opts);
    });
}

function guardar() {
    const datos = {
        nombre: $('#nombre').val().trim(),
        apP_Residente: $('#apP_Residente').val().trim(),
        apM_Residente: $('#apM_Residente').val().trim(),
        correo: $('#correo').val().trim(),
        telefono: $('#telefono').val().trim(),
        id_unidad: $('#id_unidad').val(),
        password: $('#password').val()
    };

    if (!datos.nombre || !datos.apP_Residente || !datos.correo) {
        return Swal.fire('Campos requeridos', 'Nombre, apellido paterno y correo son obligatorios.', 'warning');
    }

    const url = modoEdicion ? '/api/residentes/update' : '/api/residentes';
    if (modoEdicion) datos.id = idEditando;

    $.post(url, datos, function (res) {
        if (res.ok) {
            $('#modal-residente').modal('hide');
            cargarTabla();
            Swal.fire({ icon: 'success', title: modoEdicion ? 'Actualizado' : 'Registrado', timer: 1500, showConfirmButton: false });
        } else {
            Swal.fire('Error', res.msg || 'No se pudo guardar.', 'error');
        }
    }, 'json');
}

function editar(id) {
    $.getJSON('/api/residentes', function (res) {
        const r = (res.data || []).find(x => x.id == id);
        if (!r) return;
        modoEdicion = true;
        idEditando = id;
        cargarUnidades();
        $('#nombre').val(r.nombre);
        $('#apP_Residente').val(r.apP_Residente);
        $('#apM_Residente').val(r.apM_Residente);
        $('#correo').val(r.correo);
        $('#telefono').val(r.telefono);
        $('#password').val('');
        setTimeout(() => $('#id_unidad').val(r.id_unidad), 300);
        $('.modal-title').text('Editar Residente');
        $('#modal-residente').modal('show');
    });
}

function eliminar(id) {
    Swal.fire({
        title: '¿Eliminar residente?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, eliminar'
    }).then(r => {
        if (!r.isConfirmed) return;
        $.post('/api/residentes/delete', { id }, function (res) {
            if (res.ok) {
                cargarTabla();
                Swal.fire({ icon: 'success', title: 'Eliminado', timer: 1200, showConfirmButton: false });
            } else {
                Swal.fire('Error', res.msg || 'No se pudo eliminar.', 'error');
            }
        }, 'json');
    });
}
