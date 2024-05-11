<?php
$con = $_GET["id_control_usuario"];
$mysqli = new mysqli("localhost","root","","test");
//print_r($constante);
// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
// Perform query
$variable = $mysqli -> query("DELETE FROM control_usuario WHERE id_control_usuario = ('$con');");
$json['Estado'] = "OK";

print_r(json_encode($json));
//echo $rows[0]["razon"];
$mysqli -> close();
?>