<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "residentia");
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}
// Perform query
$variable = $mysqli->query("SELECT * FROM `vehiculo`");
$rows = $variable->fetch_all(MYSQLI_ASSOC);
$tbl = "<table id='TablaVehiculo' class='table table-bordered table-hover'> ";
$tbl .= "<thead><tr>
   <th>ID_VEHICULO</th>
  <th>MARCA</th>
  <th>MODELO</th>
  <th>COLOR</th>
  <th>MATRICULA</th>
  <th>AGREGAR</th>
  <th>COCHE</th>
  <th>ELIMINAR</th>
  </tr></thead>";

foreach ($rows as $vehiculo) {
  $id_vehiculo = $vehiculo["id_vehiculo"];
  $marca = $vehiculo["marca"];
  $modelo = $vehiculo["modelo"];
  $color = $vehiculo["color"];
  $n_matricula = $vehiculo["num_matricula"];
  $tbl .= "<tr>
    <td>$id_vehiculo</td>
    <td>$marca</td>
    <td>$modelo</td>
    <td>$color</td>
    <td>$n_matricula</td>
    <td><button class='btn btn-primary btn-block' onclick='agregarCasa(\"\");'>AGREGAR</button></td>
    <td><button class='btn btn-primary btn-block' onclick='consultarCasa(\"\");'>CONSULTAR</button></td>
    <td><button class='btn btn-primary btn-block' onclick='eliminar(\"$id_vehiculo\");'>ELIMINAR</button></td>
    </tr>";
}
$tbl .= "</table>";
$json['Estado'] = "OK";
$json['respuesta'] = $tbl;

print_r(json_encode($json));

$mysqli->close();

?>
