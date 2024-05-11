<?php
    $nombre=$_GET["nombre"];
    $correo=$_GET["correo"];
    $rol=$_GET["rol"];
    $pass=$_GET["pass"];
    $nombre_privada=$_GET["nombre_privada"];
   
    $mysqli = new mysqli("localhost","root","","test");
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
// Perform query

$sql="INSERT INTO registro(nombre,permiso,correo,pass,nombre_privada) VALUES ('".$nombre."','".$rol."','".$correo."','".$pass."','".$nombre_privada."')";
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