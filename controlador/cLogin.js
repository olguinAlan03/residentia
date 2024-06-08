$(document).ready(function(){
    $("#inicio").click(function(e){
        //e.preventDefault();

        id_residente = $("#clvresidente").val();
        usuario = $("#usuario").val();
        pass=$("#pass").val();


        
    const options ={
        method: "GET"
    };

    fetch("../modelo/mlogin.php?id_residente=" + id_residente + "&usuario=" + usuario + "&password=" + pass , options)
    .then(Response => Response.json())
    .then(data =>{ 
        console.log(data);
        if(data["Estado"] == "OK"){
         if(data["id_rol"] == 1){
            $(location).attr('href' ,'vMenu.php');
        }
        else{
            //if(data["permiso"] == 2){
               // $(location).attr('href' ,'../principal.html');
           // }
        }
    }
    else{
        alert("No encontrado");
      
        
        
    }
    })
    e.preventDefault();
    e.stopPropagation();
    })
})