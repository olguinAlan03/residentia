<?php require_once __DIR__ . '/../layout/top.php'; ?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"><h1>Reservas</h1></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
          <li class="breadcrumb-item active">Reservas</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-4">
        <div class="card card-primary card-outline">
          <div class="card-header"><h5 class="card-title m-0">Nueva Reserva</h5></div>
          <div class="card-body">
            <div class="form-group">
              <label>Área Común:</label>
              <select id="area_comun" class="form-control">
                <option value="">-- Selecciona --</option>
                <option>Salón de Eventos</option>
                <option>Alberca</option>
                <option>Gimnasio</option>
                <option>Cancha de Futbol</option>
              </select>
            </div>
            <div class="form-group">
              <label>Fecha:</label>
              <input id="fecha_reserva" type="date" class="form-control">
            </div>
            <div class="form-group">
              <label>Horario:</label>
              <input id="horario" type="text" class="form-control" placeholder="Ej: 10:00 - 12:00">
            </div>
            <div class="form-group">
              <label>Comprobante de Pago:</label>
              <input id="id_comprobante_pago" type="text" class="form-control" placeholder="Folio o referencia">
            </div>
            <button id="guardarReserva" class="btn btn-primary btn-block">
              <i class="fas fa-save"></i> Guardar Reserva
            </button>
          </div>
        </div>
      </div>

      <div class="col-md-8">
        <div class="card card-outline card-success">
          <div class="card-header"><h5 class="card-title m-0">Reservas Registradas</h5></div>
          <div class="card-body p-0">
            <table id="tablaReservas" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Área</th>
                  <th>Residente</th>
                  <th>Unidad</th>
                  <th>Fecha</th>
                  <th>Horario</th>
                  <th>Comprobante</th>
                </tr>
              </thead>
              <tbody id="tbodyReservas"></tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<script>
$(document).ready(function () {
  cargarReservas();

  $("#guardarReserva").click(function () {
    const fd = new FormData();
    fd.append("area_comun",          $("#area_comun").val());
    fd.append("fecha_reserva",       $("#fecha_reserva").val());
    fd.append("horario",             $("#horario").val());
    fd.append("id_comprobante_pago", $("#id_comprobante_pago").val());

    fetch("/api/reservas", { method: "POST", body: fd })
      .then(r => r.json())
      .then(data => {
        if (data.ok) {
          Swal.fire({ icon: "success", title: "Reserva registrada", timer: 1500, showConfirmButton: false });
          $("#area_comun, #fecha_reserva, #horario, #id_comprobante_pago").val("");
          cargarReservas();
        } else {
          Swal.fire({ icon: "error", title: "Error", text: data.msg || "No se pudo guardar" });
        }
      });
  });

  function cargarReservas() {
    fetch("/api/reservas")
      .then(r => r.json())
      .then(data => {
        const rows = (data.data || []).map(r => `
          <tr>
            <td>${r.id}</td>
            <td>${r.nombre_area || '-'}</td>
            <td>${r.residente_nombre || '<span class="text-muted">Portal</span>'}</td>
            <td>${r.numero_unidad || '-'}</td>
            <td>${r.fecha || '-'}</td>
            <td>${r.horario || '-'}</td>
            <td>${r.id_comprobante_pago || '-'}</td>
          </tr>`).join('') || '<tr><td colspan="7" class="text-center text-muted">Sin reservas registradas</td></tr>';
        $("#tbodyReservas").html(rows);
      });
  }
});
</script>

<?php require_once __DIR__ . '/../layout/bottom.php'; ?>
