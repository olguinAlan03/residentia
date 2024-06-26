$(document).ready(function(){
    selectRol();

    $("#registra").click(function(e){
        //e.preventDefault();
       // rol= $('2').val();
        clvResidente=$("#claveR").val();
        pass=$("#pass").val();
        //nombre_privada=$("#nombre_privada").val();
       

    const options ={
        method: "GET"
    };
    //rol="+ rol + "&
    uri="../modelo/mRegistroUs.php?"+ "claveR=" + clvResidente + "&pass=" + pass
    fetch(uri, options)
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