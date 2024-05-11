$(document).ready(function(){
    selectRol();

    $("#registra").click(function(e){
        //e.preventDefault();
        nombre=$("#nombre").val();
        rol= $("#select-rol option:selected").val();
        //permiso=$("#permiso").val();
        correo=$("#correo").val();
        pass=$("#pass").val();
        nombre_privada=$("#nombre_privada").val();
       

    const options ={
        method: "GET"
    };

    fetch("../modelo/registro.php?nombre="+ nombre + "&rol=" + rol + "&correo=" + correo + "&pass=" + pass + "&nombre_privada=" + nombre_privada, options)
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