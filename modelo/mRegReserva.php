<?php
    $nombre=$_GET["nombre"];
    $area_comun=$_GET["area_comun"];
    $fecha_reserva=$_GET["fecha_reserva"];
    $telefono=$_GET["telefono"];
    
    $mysqli = new mysqli("localhost","root","","test");
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
// Perform query

$sql="INSERT INTO reserva(nombre,area_comun,fecha_reserva,telefono) VALUES ('".$nombre."','".$area_comun."','".$fecha_reserva."','".$telefono."')";
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