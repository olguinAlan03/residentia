<?php
$mysqli = new mysqli("localhost", "root", "", "test");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
// Perform query
$variable = $mysqli->query("SELECT * FROM `area`");
$rows = $variable->fetch_all(MYSQLI_ASSOC);

$select = "<option id='0' value='0'>Selecciona un área común</option>";
foreach ($rows as $area) {
    $id_area = $area["id_area"];
    $area = $area["area"];

    $select .= "<option id=" . $id_area . " value=" . $id_area . ">" . $area . "</option>";
}
$json['Estado'] = "OK";
$json['respuesta'] = $select;

print_r(json_encode($json));

$mysqli->close();
?>