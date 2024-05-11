<?php
$con = $_GET["id_prueba"];
$mysqli = new mysqli("localhost","root","","test");
//print_r($constante);
// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
// Perform query
$variable = $mysqli -> query("DELETE FROM prueba WHERE id_prueba = ('$con');");
$json['Estado'] = "OK";

print_r(json_encode($json));
//echo $rows[0]["razon"];
$mysqli -> close();
?>