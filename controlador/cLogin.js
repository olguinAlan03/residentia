$(document).ready(function(){
    $("#inicio").click(function(e){
        //e.preventDefault();

        claveR = $("#claveR").val();
        //usuario = $("#usuario").val();
        pass=$("#pass").val();


        
    const options ={
        method: "GET"
    };

    fetch("../modelo/mlogin.php?claveR=" + claveR + "&pass=" + pass , options)
    .then(Response => Response.json())
    .then(data =>{ 
        console.log(data);
        if(data["respuesta"]== "YES" /*&& permiso=="Administrador"*/){
                Swal.fire({
                    icon: 'success',
                    title: 'USUARIO ENCONTRADO',
                    text: 'Haz click en el boton',  
                });
                setTimeout(function() {
                }, 1000);
                $(location).attr('href' ,'../ejemploResidenSSIN.php');
             
            /*alert("Encontrado");
            $(location).attr('href', 'vMenu.php');*/
        }
        else{
            Swal.fire({
                icon: 'warning',
                title: 'DATOS INCORRECTOS',
                text: 'Haz click en el boton',  
            });
            setTimeout(function() {
            }, 2000);
        }
        /*if(data["Estado"] == "OK"){
            if(data["id_rol"] == 2){
               $(location).attr('href' ,'../ejemploResidenSSIN.html');
            } 
        }
        else{ 
            alert("No encontrado");  
        }*/
        })
    e.preventDefault();
    e.stopPropagation();
    })
})