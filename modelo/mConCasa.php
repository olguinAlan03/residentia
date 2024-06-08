<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "residentia");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
$idResidente = $_GET["idResidente"];
$variable = $mysqli->query("SELECT id_residente, calle, num_exterior, codigo_postal, estatus, modelo, num_habitantes, num_vehiculos FROM casa WHERE id_residente = $idResidente");
$rows = $variable->fetch_all(MYSQLI_ASSOC);

$tbl = "<table id='TablaCasa' class='table table-bordered table-hover'>";
$tbl .= "<thead><tr>
<th>CALLE</th>
<th>NUM. EXTERIOR</th>
<th>CODIGO POSTAL</th>
<th>ESTATUS</th>
<th>MODELO</th>
<th>NUM. HABITANTES</th>
<th>NUM. VEHICULOS</th>
<th>MODIFICAR</th>
</tr></thead><tbody>";

foreach ($rows as $residente) {
    $id_residente = $residente["id_residente"];
    $calle = $residente["calle"];
    $num_exterior = $residente["num_exterior"];
    $codigo_postal = $residente["codigo_postal"];
    $estatus = $residente["estatus"];
    $modelo = $residente["modelo"];
    $num_habitantes = $residente["num_habitantes"];
    $num_vehiculos = $residente["num_vehiculos"];
    
    $tbl .= "<tr>
        <td>$calle</td>
        <td>$num_exterior</td>
        <td>$codigo_postal</td>
        <td>$estatus</td>
        <td>$modelo</td>
        <td>$num_habitantes</td>
        <td>$num_vehiculos</td>
        <td><button class='btn btn-primary btn-block' onclick='modificar(\"$id_residente\");'>MODIFICAR</button></td>
    </tr>";
}

$tbl .= "</tbody></table>";
$json['Estado'] = "OK";
$json['respuesta'] = $tbl;

echo json_encode($json);
$mysqli->close();
?>
