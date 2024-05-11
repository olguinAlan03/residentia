$(document).ready(function(){
    $("#inicio").click(function(e){
        //e.preventDefault();
        nombre=$("#usuario").val();
        pass=$("#pass").val();


        
    const options ={
        method: "GET"
    };

    fetch("../modelo/mlogin.php?nombre=" + nombre + "&pass=" + pass , options)
    .then(Response => Response.json())
    .then(data =>{ 
        console.log(data);
        if(data["Estado"] == "OK"){
         if(data["permiso"] == 1){
            $(location).attr('href' ,'vMenu.php');
        }
        else{
            $(location).attr('href' ,'vMenu.php');
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