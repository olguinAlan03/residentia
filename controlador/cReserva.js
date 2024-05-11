$(document).ready(function () {
    $('#reservation').daterangepicker({
        "singleDatePicker": true,
        "startDate": "06/23/2023",
        "endDate": "06/29/2023",
        "opens": "center",
        "drops": "up"
    }, function(start, end, label) {
      console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });

    selectAreaComun();

    $("#registra").click(function(e){
        //e.preventDefault();
        nombre=$("#nombre").val();
        area= $("#select-AreaComun option:selected").val();
        //permiso=$("#permiso").val();
       // area=$("#area").val();
        reservation=$("#reservation").val();
        privada=$("#privada").val();
        tel=$("#tel").val();
       
       

    const options ={
        method: "GET"
    };

    fetch("../modelo/mReserva.php?area="+ area + "&fecha=" + reservation+ "&privada=" + privada + "&tel=" + tel, options)
    .then(Response => Response.json())
    .then(data => {
        if(data["Estado"] == "OK"){
            alert("REGISTRADO");
            $(location).attr('href' ,'vLogin.php');
        }
        else{
            alert("NO REGISTRADO");
        }
    })

    e.preventDefault();
    e.stopPropagation();
    })
})
function selectAreaComun(){
    const options = {
        method: "GET"
    };

url = "../modelo/mConsultaArea.php";
fetch(url, options)
.then(Response => Response.json())
.then(data => {
    console.log(data);
    if (data["Estado"] == "OK"){
        $("#select-AreaComun").html(data["respuesta"]);

    }
})
}