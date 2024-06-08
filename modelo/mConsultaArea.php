<?php
$mysqli = new mysqli("localhost", "root", "", "residentia");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
// Perform query
$variable = $mysqli->query("SELECT * FROM `alta_area`");
$rows = $variable->fetch_all(MYSQLI_ASSOC);

$select = "<option id='0' value='0'>Selecciona un área común</option>";
foreach ($rows as $alta_area) {
    $id_alta_area = $alta_area["id_alta_area"];
    $nombre_area = $alta_area["nombre_area"];

    $select .= "<option id=" . $id_alta_area . " value=" . $id_alta_area . ">" . $alta_area . "</option>";
}
$json['Estado'] = "OK";
$json['respuesta'] = $select;

print_r(json_encode($json));

$mysqli->close();
?>