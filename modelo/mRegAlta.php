<?php
    $nombre_area=$_GET["nombre_area"];
    $tipo_area=$_GET["tipo_area"];
    $capacidad=$_GET["capacidad"];
    $ubicacion=$_GET["ubicacion"];
    $tarifa_alquiler=$_GET["tarifa_alquiler"];
   
    $mysqli = new mysqli("localhost","root","","residentia");
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
// Perform query

$sql="INSERT INTO alta_area(nombre_area,tipo_area,capacidad,ubicacion,tarifa_alquiler) 
VALUES ('".$nombre_area."','".$tipo_area."','".$capacidad."','".$ubicacion."','".$tarifa_alquiler."')";
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