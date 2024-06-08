$(document).ready(function(){
    $("#cerrar_sesion1").click(function (e) {

        e.preventDefault();
        $(location).attr('href' , 'vLogin.php');     
        e.preventDefault();
        e.stopPropagation();
    });

    $("#regresar1").click(function (e) {

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

            $("#guardar").click(function(){
                area_comun= $("#area_comun").val();
                fecha_reserva= $("#reservation").val();
                horario= $("#horario").val();
                id_comprobante_pago= $("#id_comprobante_pago").val();
                rol= $("#select-rol option:selected").val();
                
                const options = {
                    method: "GET"
                };

            url = "../modelo/mRegReserva.php?area_comun="+area_comun+"&fecha_reserva="+fecha_reserva+"&horario="+horario+"&id_comprobante_pago="+id_comprobante_pago; 
            console.log(url);
            fetch(url, options)
            .then(Response => Response.json())
            .then(data => {
                    alert("GUARDADO");
                })
                e.preventDefault();
                e.stopPropagation();
        
        })
    });
        function dibujaTabla(){
            fetch("../modelo/mTablaReserva.php")
                .then(Response => Response.json())
                .then(data => {
                    rpt=data["respuesta"];
                    $("#divTablaRE").html(rpt);
                    $('#TabReser').DataTable({
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
function eliminar(id_area){
            fetch("../modelo/mEliminarAgenda.php?id_area="+id_area)
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
 