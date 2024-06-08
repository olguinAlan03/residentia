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
        area_comun= $("#select-AreaComun option:selected").val();
        fecha_reserva=$("#reservation").val();
        horario=$("#horario").val();
        id_comprobante_pago=$("#id_comprobante_pago").val();
       
    const options ={
        method: "GET"
    };

    fetch("../modelo/mReserva.php?area_comun="+ area_comun + "&fecha_reserva=" + fecha_reserva+ "&horario=" + horario + "&id_comprobante_pago=" + id_comprobante_pago, options)
    .then(Response => Response.json())
    .then(data => {
        if(data["Estado"] == "OK"){
            //alert("REGISTRADO");
            Swal.fire({
                type: 'success',
                title: 'RESERVA EXITOSA',
                text: 'Haz click en el boton',  
              });
              setTimeout(function() {
                $(location).attr('href' ,'../principal.html');
              }, 2000);
        }
        else{
            alert("NO REGISTRADO");
        }
    })

    e.preventDefault();
    e.stopPropagation();
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

function reserve(name, lastName, phone, email, date, time) {
    console.log("reservando..")

    db.collection("bookings").add({
        name: name,
        lastName: lastName,
        phone: phone,
        email: email,
        date: date,
        time: time
    })
        .then(function (docRef) {
            console.log("Document written with ID: ", docRef.id);
            cleanInputs()
            Swal.fire(
                'Reserva Exitosa!',
                '',
                'success'
            )
        })
        .catch(function (error) {
            console.error("Error adding document: ", error);
        });
}

})

$("#btn2").click(function(){
    Swal.fire({        
        type: 'success',
        title: 'Éxito',
        text: '¡Perfecto!',        
    });
});	