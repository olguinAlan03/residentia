$(document).ready(function () {
    $("#inicio").click(function (e) {
        e.preventDefault();
        e.stopPropagation();

        const user = $("#claveR").val().trim();
        const pass = $("#pass").val();

        if (!user || !pass) {
            Swal.fire({ icon: 'warning', title: 'Campos vacíos', text: 'Ingresa tu clave y contraseña' });
            return;
        }

        const fd = new FormData();
        fd.append("user",     user);
        fd.append("password", pass);

        fetch("/api/login", { method: "POST", body: fd })
            .then(r => r.json())
            .then(data => {
                if (data["respuesta"] === "YES") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Bienvenido',
                        timer: 1200,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '/portal';
                    });
                } else {
                    Swal.fire({ icon: 'warning', title: 'Datos incorrectos', text: 'Clave o contraseña incorrectos' });
                }
            })
            .catch(() => {
                Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo conectar con el servidor' });
            });
    });
});
