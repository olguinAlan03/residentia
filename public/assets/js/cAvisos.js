$(function () {
    cargarAvisos();

    $('#btnPublicar').on('click', function () {
        const titulo = $('#titulo').val().trim();
        const contenido = $('#contenido').val().trim();

        if (!titulo || !contenido) {
            return Swal.fire('Campos requeridos', 'Título y contenido son obligatorios.', 'warning');
        }

        $.post('/api/avisos', { titulo, contenido }, function (res) {
            if (res.ok) {
                $('#titulo').val('');
                $('#contenido').val('');
                cargarAvisos();
                Swal.fire({ icon: 'success', title: 'Aviso publicado', timer: 1400, showConfirmButton: false });
            } else {
                Swal.fire('Error', res.msg || 'No se pudo publicar.', 'error');
            }
        }, 'json');
    });
});

function cargarAvisos() {
    $.getJSON('/api/avisos', function (res) {
        const avisos = res.data || [];
        if (!avisos.length) {
            $('#divAvisos').html('<div class="text-center p-4 text-muted"><i class="fas fa-inbox fa-2x mb-2 d-block"></i>No hay comunicados publicados.</div>');
            return;
        }

        const html = avisos.map(a => `
            <div class="p-3 border-bottom">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <strong>${escHtml(a.titulo)}</strong>
                        <span class="badge ml-2 ${a.activo ? 'badge-success' : 'badge-secondary'}">${a.activo ? 'Activo' : 'Inactivo'}</span>
                        <div class="text-muted small mt-1">${escHtml(a.contenido)}</div>
                        <small class="text-muted">${formatFecha(a.fecha_publicacion)}</small>
                    </div>
                    <div class="ml-2 d-flex flex-column" style="gap:4px">
                        <button class="btn btn-xs ${a.activo ? 'btn-warning' : 'btn-success'}" onclick="toggleAviso(${a.id})">
                            <i class="fas ${a.activo ? 'fa-eye-slash' : 'fa-eye'}"></i>
                        </button>
                        <button class="btn btn-xs btn-danger" onclick="eliminarAviso(${a.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>`).join('');

        $('#divAvisos').html(html);
    });
}

function toggleAviso(id) {
    $.post('/api/avisos/toggle', { id }, function (res) {
        if (res.ok) cargarAvisos();
        else Swal.fire('Error', res.msg || 'No se pudo cambiar el estado.', 'error');
    }, 'json');
}

function eliminarAviso(id) {
    Swal.fire({
        title: '¿Eliminar aviso?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Eliminar'
    }).then(r => {
        if (!r.isConfirmed) return;
        $.post('/api/avisos/delete', { id }, function (res) {
            if (res.ok) {
                cargarAvisos();
                Swal.fire({ icon: 'success', title: 'Eliminado', timer: 1200, showConfirmButton: false });
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
    if (!str) return '';
    const d = new Date(str);
    return d.toLocaleDateString('es-MX', { year:'numeric', month:'short', day:'numeric', hour:'2-digit', minute:'2-digit' });
}
