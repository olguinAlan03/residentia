<?php
$calle = $_GET["calle"];
$num_exterior = $_GET["n_ext"];
$codigo_postal = $_GET["c_p"];
$estatus = $_GET["estatus"];
$modelo = $_GET["modelo"];
$num_habitantes = $_GET["n_habitantes"];
$num_vehiculos = $_GET["n_vehiculos"];
$idResidente = $_GET["idResidente"];

$mysqli = new mysqli("localhost", "root", "", "residentia");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$sql = "INSERT INTO casa(calle, num_exterior, codigo_postal, estatus, modelo, num_habitantes, num_vehiculos,	
id_residente) VALUES ('$calle', '$num_exterior', '$codigo_postal', '$estatus', '$modelo', '$num_habitantes', '$num_vehiculos', '$idResidente')";

if ($mysqli->query($sql) === TRUE) {
    $json['Estado'] = "OK";
    echo json_encode($json);
} else {
    $json['Estado'] = "ERROR";
    echo json_encode($json);
}

$mysqli->close();
?>
