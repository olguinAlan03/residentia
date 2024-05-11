<?php
    $area=$_GET["area"];
    $reservation=$_GET["fecha"];
    $privada=$_GET["privada"];
    $tel=$_GET["tel"];
    
   
    $mysqli = new mysqli("localhost","root","","test");
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
// Perform query

$sql="INSERT INTO prueba(area,fecha,privada,telefono) VALUES ('".$area."','".$reservation."','".$privada."','".$tel."')";
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
