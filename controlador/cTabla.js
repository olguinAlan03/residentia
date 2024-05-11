$(document).ready(function(){

    $("#cerrar_sesion").click(function (e) {

        e.preventDefault();
        $(location).attr('href' , 'vLogin.php');     
        e.preventDefault();
        e.stopPropagation();
    });

    $("#regresar").click(function (e) {

        e.preventDefault();
        $(location).attr('href' , 'vMenu.php');     
        e.preventDefault();
        e.stopPropagation();
    });

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
    $('#reservation').daterangepicker({
        "startDate": "06/23/2023",
        "endDate": "06/29/2023",
        "opens": "center"
    }, 
    function (start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });

    
    //Boton permisos
    //permiso=$("#nombre").val();
    //if (permiso=="ALAN"){
      //  $("#agregar").hide();
    //}
    dibujaTabla();
    selectRol();
   
            $("#agregar").click(function(){
                $("#modal-registro").modal();
            });

            $("#guardar").click(function(){
                nombre= $("#nombre_usuario").val();
                correo= $("#correo").val();
                telefono= $("#telefono").val();
                nombre_privada= $("#nombre_privada").val();
                rol= $("#select-rol option:selected").val();
                
                const options = {
                    method: "GET"
                };

            url = "../modelo/mRegTabla.php?nombre_usuario="+nombre+"&correo="+correo+"&telefono="+telefono+"&nombre_privada="+nombre_privada+"&rol="+rol; 
            console.log(url);
            fetch(url, options)
            .then(Response => Response.json())
            .then(data => {
                console.log(data);
                if (data["Estado"] == "OK"){
                    $("#modal-registro").modal('toggle');
                    alert ("GUARDADO");
                   // $("#texto").html("Guardado con exito");
                  //  $("#modal-confirmacion").();
                  $("#nombre_usuario").val("");
                  $("#correo").val("");
                  $("#telefono").val("");
                  $("#nombre_privada").val("");
                  $("#select-rol").val(0);

                    dibujaTabla();
                }
                else{
                    alert ("NO GUARDADO");
                 /*   $("#texto").html("No guardado");
                    $("#modal-confirmacion").modal();*/
                
                }
            })
        })
    });
    function dibujaTabla(){
        fetch("../modelo/mTabla.php")
            .then(Response => Response.json())
            .then(data => {
                
                rpt=data["respuesta"];
                $("#divTablaReserva").html(rpt);
                $('#TablaReserva').DataTable({
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
function eliminar(id_control_usuario){
            fetch("../modelo/meliminar.php?id_control_usuario="+id_control_usuario)
                .then(Response => Response.json())
                .then(data => {
                    if (data["Estado"] == "OK"){
            
                        alert ("ELIMINADO");
                       
                        dibujaTabla();
                    }
                    else{
                        alert ("NO ELIMINADO");
                    
                    
                    }
                      }); 
                }
            function selectRol(){
                const options = {
                    method: "GET"
                };

            url = "../modelo/mConsultaRol.php";
            fetch(url, options)
            .then(Response => Response.json())
            .then(data => {
                console.log(data);
                if (data["Estado"] == "OK"){
                    $("#select-rol").html(data["respuesta"]);

                }
            })
            }