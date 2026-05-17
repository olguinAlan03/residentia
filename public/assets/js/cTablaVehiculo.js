let idVehiculoGlobal = 0;

$(document).ready(function () {
    cargarResidentes();
    dibujaTabla();

    $("#agregar").click(function () {
        $("#marca, #modelo, #color, #n_matricula").val("");
        $("#id_residente").val("");
        $("#modal-registro").modal("show");
    });

    $("#guardar").click(function () {
        const fd = new FormData();
        fd.append("id_residente",  $("#id_residente").val());
        fd.append("marca",         $("#marca").val().trim());
        fd.append("modelo",        $("#modelo").val().trim());
        fd.append("color",         $("#color").val().trim());
        fd.append("num_matricula", $("#n_matricula").val().trim());

        fetch("/api/vehiculos", { method: "POST", body: fd })
            .then(r => r.json())
            .then(data => {
                if (data["Estado"] === "OK") {
                    $("#modal-registro").modal("hide");
                    Swal.fire({ icon: "success", title: "Vehículo registrado", timer: 1500, showConfirmButton: false });
                    dibujaTabla();
                } else {
                    Swal.fire({ icon: "error", title: "Error", text: data["respuesta"] || "No se pudo registrar" });
                }
            });
    });

    $("#guardarTag").click(function () {
        const fd = new FormData();
        fd.append("n_tag",        $("#n_tag").val().trim());
        fd.append("id_vehiculo",  idVehiculoGlobal);
        fd.append("f_registro",   $("#f_registro").val());
        fd.append("f_vencimiento",$("#f_vencimiento").val());

        fetch("/api/tags", { method: "POST", body: fd })
            .then(r => r.json())
            .then(data => {
                if (data["Estado"] === "OK") {
                    $("#modal-tag").modal("hide");
                    Swal.fire({ icon: "success", title: "Tag registrado", timer: 1500, showConfirmButton: false });
                    $("#n_tag, #f_registro, #f_vencimiento").val("");
                } else {
                    Swal.fire({ icon: "error", title: "Error", text: data["respuesta"] || "No se pudo registrar el tag" });
                }
            });
    });
});

function cargarResidentes() {
    $.getJSON("/api/residentes", function (res) {
        let opts = '<option value="">-- Sin asignar --</option>';
        (res.data || []).forEach(r => {
            opts += `<option value="${r.id}">${r.apP_Residente} ${r.nombre}${r.numero_unidad ? ' — Unidad ' + r.numero_unidad : ''}</option>`;
        });
        $("#id_residente").html(opts);
    });
}

function dibujaTabla() {
    fetch("/api/vehiculos")
        .then(r => r.json())
        .then(data => {
            if (data["Estado"] !== "OK") return;

            const vehiculos = data["respuesta"];
            const rows = vehiculos.map(v => `
                <tr>
                    <td>${v.id_vehiculo}</td>
                    <td>${v.residente_nombre ? esc(v.residente_nombre) : '<span class="text-muted">Sin asignar</span>'}
                        ${v.numero_unidad ? `<br><small class="text-muted">Unidad ${v.numero_unidad}</small>` : ''}
                    </td>
                    <td>${v.marca}</td>
                    <td>${v.modelo}</td>
                    <td>${v.color || '—'}</td>
                    <td><code>${v.num_matricula}</code></td>
                    <td>
                      <button class="btn btn-sm btn-info" onclick="agregarTag(${v.id_vehiculo})">
                        <i class="fas fa-tag"></i> Tag
                      </button>
                    </td>
                    <td>
                      <button class="btn btn-sm btn-secondary" onclick="consultarTag(${v.id_vehiculo})">
                        <i class="fas fa-search"></i>
                      </button>
                    </td>
                    <td>
                      <button class="btn btn-sm btn-danger" onclick="eliminar(${v.id_vehiculo})">
                        <i class="fas fa-trash"></i>
                      </button>
                    </td>
                </tr>
            `).join("");

            const tabla = `
                <table id="TablaVehiculo" class="table table-bordered table-hover table-sm">
                  <thead class="thead-dark">
                    <tr>
                      <th>#</th><th>Propietario</th><th>Marca</th><th>Modelo</th>
                      <th>Color</th><th>Matrícula</th><th>Agregar Tag</th><th>Ver Tags</th><th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>${rows || '<tr><td colspan="9" class="text-center text-muted">Sin vehículos registrados.</td></tr>'}</tbody>
                </table>`;

            $("#divTablaVehiculo").html(tabla);

            if ($.fn.DataTable.isDataTable("#TablaVehiculo")) {
                $("#TablaVehiculo").DataTable().destroy();
            }
            $("#TablaVehiculo").DataTable({
                paging: true,
                lengthChange: false,
                searching: true,
                ordering: true,
                responsive: true,
                language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json', search: "Buscar:" }
            });
        });
}

function agregarTag(idVehiculo) {
    idVehiculoGlobal = idVehiculo;
    $("#modal-tag").modal("show");
}

function consultarTag(idVehiculo) {
    fetch(`/api/tags?idVehiculo=${idVehiculo}`)
        .then(r => r.json())
        .then(data => {
            if (data["Estado"] !== "OK" || !data["respuesta"].length) {
                $("#divTablaTag").html("<p class='text-muted p-3'>Sin tags registrados para este vehículo.</p>");
            } else {
                const rows = data["respuesta"].map(t => `
                    <tr>
                        <td>${t.id_tag}</td>
                        <td><code>${t.codigo_tag}</code></td>
                        <td>${t.f_registro ?? "—"}</td>
                        <td>${t.f_vencimiento ?? "—"}</td>
                    </tr>`).join("");
                $("#divTablaTag").html(`
                    <table class="table table-bordered table-sm">
                      <thead><tr><th>#</th><th>Código</th><th>F. Registro</th><th>F. Vencimiento</th></tr></thead>
                      <tbody>${rows}</tbody>
                    </table>`);
            }
            $("#modal-consulta-tag").modal("show");
        });
}

function eliminar(idVehiculo) {
    Swal.fire({
        title: "¿Eliminar vehículo?",
        text: "Esta acción no se puede deshacer.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Sí, eliminar"
    }).then(result => {
        if (!result.isConfirmed) return;

        const fd = new FormData();
        fd.append("id_vehiculo", idVehiculo);

        fetch("/api/vehiculos/delete", { method: "POST", body: fd })
            .then(r => r.json())
            .then(data => {
                if (data["Estado"] === "OK") {
                    Swal.fire({ icon: "success", title: "Eliminado", timer: 1200, showConfirmButton: false });
                    dibujaTabla();
                } else {
                    Swal.fire({ icon: "error", title: "Error al eliminar" });
                }
            });
    });
}

function esc(s) {
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

window.agregarTag   = agregarTag;
window.consultarTag = consultarTag;
window.eliminar     = eliminar;
