<?php
$con = $_GET["id_alta_area"];
$mysqli = new mysqli("localhost", "root", "", "residentia");
//print_r($constante);
// Check connection
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}
// Perform query
$variable = $mysqli->query("DELETE FROM alta_area WHERE id_alta_area = ('$con');");
$json['Estado'] = "OK";

print_r(json_encode($json));
//echo $rows[0]["razon"];
$mysqli->close();
