<?php
$mysqli = new mysqli("localhost", "root", "", "residentia");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
// Perform query
$variable = $mysqli->query("SELECT * FROM `rol`");
$rows = $variable->fetch_all(MYSQLI_ASSOC);

$select = "<option id='0' value='0'>Selecciona una opción</option>";
foreach ($rows as $rol) {
    $id_rol = $rol["id_rol"];
    $nombre = $rol["rol"];

    $select .= "<option id=" . $id_rol . " value=" . $id_rol . ">" . $nombre . "</option>";
}
$json['Estado'] = "OK";
$json['respuesta'] = $select;

print_r(json_encode($json));

$mysqli->close();
?>