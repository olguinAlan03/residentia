<?php
    $nombre=$_GET["nombre_usuario"];
    $correo=$_GET["correo"];
    $telefono=$_GET["telefono"];
    $nombre_privada=$_GET["nombre_privada"];
    $rol=$_GET["rol"];
   
    $mysqli = new mysqli("localhost","root","","test");
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
// Perform query

$sql="INSERT INTO control_usuario(nombre_usuario,correo,telefono,nombre_privada,id_rol) VALUES ('".$nombre."','".$correo."','".$telefono."','".$nombre_privada."','".$rol."')";
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