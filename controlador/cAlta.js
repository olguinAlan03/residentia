$(document).ready(function () {
    dibujaTabla();

    $("#cerrar_sesion1").click(function (e) {

        e.preventDefault();
        $(location).attr('href', 'vLogin.php');
        e.preventDefault();
        e.stopPropagation();
    });

    $("#regresar1").click(function (e) {

        e.preventDefault();
        $(location).attr('href', 'vMenu.php');
        e.preventDefault();
        e.stopPropagation();
    });

    $("#agregar").click(function () {
        $("#modal-registro").modal();
    });
    
    $("#guardar").click(function () {
        nombre_area=$("#nombre_area").val();
        tipo_area=$("#tipo_area").val();
        capacidad=$("#capacidad").val();
        ubicacion=$("#ubicacion").val();
        tarifa_alquiler=$("#tarifa_alquiler").val();

        const options = {
            metod: "GET"
        };

        url="../modelo/mRegAlta.php?nombre_area="+nombre_area+"&tipo_area="+tipo_area+"&capacidad="+capacidad+"&ubicacion="+ubicacion+"&tarifa_alquiler="+tarifa_alquiler,options;        
        console.log(url);
        fetch(url,options)
        .then(Response => Response.json())
        .then(data => {
            console.log(data);
            if(data["Estado"]== "OK"){
                $("#modal-registro").modal('toggle');
                alert("Guardado");
                /*$("#texto").html("Guardado con exito");
                $("#modal-confirmacion").modal();*/
                 $("#nombre_area").val("");
                  $("#tipo_area").val("");
                  $("#capacidad").val("");
                  $("#ubicacion").val("");
                  $("#tarifa_alquiler").val("");
                dibujaTabla();
            }
            else{
                alert("NO guardado");
                /*$("#texto").html("No guardado");
                $("#modal-confirmacion").modal();*/
            }
        })
    })
});

function dibujaTabla() {
    fetch("../modelo/mAlta.php")
        .then(Response => Response.json())
        .then(data => {
            rpt = data["respuesta"];
            $("#divTabAlta").html(rpt);
            $('#TabAlta').DataTable({
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
function eliminar(id_alta_area) {
    fetch("../modelo/mEliminarAlta.php?id_alta_area=" + id_alta_area)
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

    /*$('#reservation').daterangepicker(
        {
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'),10),
            locale: {
                format: 'M/DD hh:mm A'
              }
        }
    )*/
    /*$('#reservation').daterangepicker({
        "startDate": "06/23/2023",
        "endDate": "06/29/2023",
        "opens": "center"
    }, 
    function (start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });*/


    //Boton permisos
    //permiso=$("#nombre").val();
    //if (permiso=="ALAN"){
    //  $("#agregar").hide();
    //}

