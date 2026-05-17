$(document).ready(function () {
    $("#inicio").click(function (e) {
        e.preventDefault();
        e.stopPropagation();

        const correo = $("#correo").val().trim();
        const pass   = $("#pass").val();

        if (!correo || !pass) {
            Swal.fire({ icon: 'warning', title: 'Campos vacíos', text: 'Ingresa tu correo y contraseña' });
            return;
        }

        const fd = new FormData();
        fd.append("correo", correo);
        fd.append("pass",   pass);

        fetch("/api/admin/login", { method: "POST", body: fd })
            .then(r => r.json())
            .then(data => {
                if (data["respuesta"] === "YES") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Bienvenido',
                        timer: 1200,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '/dashboard';
                    });
                } else {
                    Swal.fire({ icon: 'warning', title: 'Datos incorrectos', text: 'Correo o contraseña incorrectos' });
                }
            })
            .catch(() => {
                Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo conectar con el servidor' });
            });
    });
});
