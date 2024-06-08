<?php
    $area_comun=$_GET["area_comun"];
    $fecha_reserva=$_GET["fecha_reserva"];
    $horario=$_GET["horario"];
    $id_comprobante_pago=$_GET["id_comprobante_pago"];
    //$id_residente=$_GET["id_residente"];
  
     $mysqli = new mysqli("localhost","root","","residentia");
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
// Perform query

$sql="INSERT INTO reserva(area_comun,fecha_reserva,horario,id_comprobante_pago)
VALUES ('".$area_comun."','".$fecha_reserva."','".$horario."','".$id_comprobante_pago."')";

if($mysqli->query($sql)=== TRUE){
  $json['Estado'] = "OK";
  print_r(json_encode($json));
}
else{
  $json['Estado'] = "ERROR";
  print_r($sql);
}
/*$rows = $insert->fetch_all(MYSQLI_ASSOC);
$json['Estado'] = "Ok";
$json['respuesta'] = $rows;

print_r(json_encode($json));*/
//echo $rows[0]["razon"];
$mysqli -> close();
?>
