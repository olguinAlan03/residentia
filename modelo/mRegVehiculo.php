<?php
    $marca=$_GET["marca"];
    $modelo=$_GET["modelo"];
    $color=$_GET["color"];
    $n_matricula=$_GET["num_matricula"];
    

    $mysqli = new mysqli("localhost","root","","residentia");
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
// Perform query

$sql="INSERT INTO vehiculo(marca, modelo, color, num_matricula)
 VALUES ('".$marca."','".$modelo."','".$color."','".$n_matricula."')";
 
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