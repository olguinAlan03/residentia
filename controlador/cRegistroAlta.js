$(document).ready(function () {
    $("#guardar").click(function () {
        nombre_area = $("#nombre_area").val();
        tipo_area = $("#tipo_area").val();
        capacidad = $("#capacidad").val();
        ubicacion = $("#ubicacion").val();
        tarifa_alquiler = $("#tarifa_alquiler").val();

        const options = {
            method: "GET"
        };

        fetch ("../modelo/mRegAlta.php?nombre_area=" + nombre_area + "&tipo_area=" + tipo_area + "&capacidad=" + capacidad + "&ubicacion=" + ubicacion + "&tarifa_alquiler=" + tarifa_alquiler,options)
            .then(Response => Response.json())
            .then(data => {
                    alert("GUARDADO");
                })
                e.preventDefault();
                e.stopPropagation();
            })
        });
