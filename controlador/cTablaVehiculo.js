$(document).ready(function () {
    idResidenteGLOBAL = 0;

    $("#cerrar_sesion").click(function (e) {

        e.preventDefault();
        $(location).attr('href', 'vLogin.php');
        e.preventDefault();
        e.stopPropagation();
    });

    $("#regresar").click(function (e) {

        e.preventDefault();
        $(location).attr('href', 'vMenu.php');
        e.preventDefault();
        e.stopPropagation();
    });


    dibujaTabla();


    /*$("#MuestraCasa").click(function (e) {
        $("#modal-domicilio").modal();
    });
    

    $("#guardarCasa").click(function () {
        calle = $("#calle").val();
        num_exterior = $("#n_ext").val();
        codigo_postal = $("#c_p").val();
        estatus = $("#estatus").val();
        modelo = $("#modelo").val();
        num_habitantes = $("#n_habitantes").val();
        num_vehiculos = $("#n_vehiculos").val();

        const options = {
            method: "GET"
        };
        url = "../modelo/mRegCasa.php?calle=" + calle + "&n_ext=" + num_exterior + "&c_p=" + codigo_postal + "&estatus=" + estatus + "&modelo=" + modelo + "&n_habitantes=" + num_habitantes + "&n_vehiculos=" + num_vehiculos+ "&id_residente=" + id_ResidenteGLOBAL;
        console.log(url);
        fetch(url, options)
            .then(Response => Response.json())
            .then(data => {
                console.log(data);
                if (data["Estado"] == "OK") {
                    $("#modal_casa").modal('toggle');
                    Swal.fire({
                        type: 'success',
                        title: 'REGISTRO EXITOSO',
                        text: 'Haz click en el boton',  
                      });
                      setTimeout(function() {
                      }, 2000);
                    $("#calle").val("");
                    $("#n_ext").val("");
                    $("#c_p").val("");
                    $("#estatus").val("");
                    $("#modelo").val("");
                    $("#n_habitantes").val("");
                    $("#n_vehiculos").val("");

                }
                else {
                    //alert("NO GUARDADO");
                    Swal.fire({
                        type: 'error',
                        title: '¡Algo salió mal!',
                        text: 'Haz click en el boton',
                      });
                      setTimeout(function() {
                      }, 2000);
                }
            })
    });*/

    // ESTE MODAL AGREGA AL NUEVO USUARIO //

    $("#agregar").click(function () {
        $("#modal-registro").modal();
    });
    $("#guardar").click(function () {
        marca = $("#marca").val();
        modelo = $("#modelo").val();
        color = $("#color").val();
        n_matricula = $("#n_matricula").val();

        const options = {
            method: "GET"
        };


        url = "../modelo/mRegVehiculo.php?marca=" + marca + "&modelo=" + modelo + "&color=" + color + "&num_matricula=" + n_matricula;
        console.log(url);
        fetch(url, options)
            .then(Response => Response.json())
            .then(data => {
                console.log(data);
                if (data["Estado"] == "OK") {
                    $("#modal-registro").modal('toggle');
                    Swal.fire({
                        type: 'success',
                        title: 'REGISTRO EXITOSO',
                        text: 'Haz click en el boton',  
                      });
                      setTimeout(function() {
                      }, 2000);
                    $("#marca").val("");
                    $("#modelo").val("");
                    $("#color").val("");
                    $("#n_matricula").val("");

                    dibujaTabla();
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        type: 'success',
                        title: '¡Algo salió mal!',
                        text: 'Haz click en el boton',
                      });
                      setTimeout(function() {
                      }, 2000);
                    /*   $("#texto").html("No guardado");
                       $("#modal-confirmacion").modal();*/

                }
            })
    })

});

function dibujaTabla() {
    fetch("../modelo/mTablaVehiculo.php")
        .then(Response => Response.json())
        .then(data => {

            rpt = data["respuesta"];
            $("#divTablaVehiculo").html(rpt);
            $('#TablaVehiculo').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        })

}

/*function RegistraCasa(id_residente) {
    id_ResidenteGLOBAL = id_residente;
        $("#modal_casa").modal();
    
};

function Casa(id_residente) {
    id_ResidenteGLOBAL = id_residente;
        $("#modal-domicilio").modal();
    
};*/

function eliminar(id_vehiculo) {
    fetch("../modelo/meliminarVehiculo.php?id_vehiculo=" + id_vehiculo)
        .then(Response => Response.json())
        .then(data => {
            if (data["Estado"] == "OK") {

                alert("ELIMINADO");

                dibujaTabla();
            }
            else {
                alert("NO ELIMINADO");


            }
        });
}


