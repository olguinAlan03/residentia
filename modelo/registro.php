<?php
    $rol=2;
    $clvResidente=$_GET["clvResidente"];
    $usuario=$_GET["usuario"];
    $pass=$_GET["pass"];
    //$nombre_privada=$_GET["nombre_privada"];
   
    $mysqli = new mysqli("localhost","root","","residentia");
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
// Perform query
//id_rol,
$sql="INSERT INTO usuarios_pag(id_residente,nombre,passwor) VALUES ('".$clvResidente."','".$usuario."','".$pass."')";
if($mysqli->query($sql)=== TRUE){
  $json['Estado'] = "OK";
  print_r(json_encode($json));
}
else{
  $json['Estado'] = "ERROR";
  print_r(json_encode($json));
}
/*$rows = $insert->fetch_all(MYSQLI_ASSOC);
$json['Estado'] = "Ok";
$json['respuesta'] = $rows;

print_r(json_encode($json));*/
//echo $rows[0]["razon"];
$mysqli -> close();
?>