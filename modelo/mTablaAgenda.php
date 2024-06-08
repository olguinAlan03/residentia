<?php
session_start();
/*if(!isset($_SESSION['usuario']))
{
  $json['Estado'] = "ERROR";
  $json['respuesta'] = "sin token";
 print_r(json_encode($json));
  /*$url=`../vista/Vlogin.php`;
  echo "<script>alert('Sesión finalizada, ingrese sus datos nuevamente'); window.close();</script>";
	//echo "<script>alert('".$msj."'); window.close();</script>";
	session_destroy();
	//echo '<meta http-equiv=refresh content="1; '.$url.'">';
	die;
}
else{*/

$mysqli = new mysqli("localhost", "root", "", "residentia");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
// Perform query
$variable = $mysqli->query("SELECT * FROM `reservaciones`");
$rows = $variable->fetch_all(MYSQLI_ASSOC);
$tbl = "<table id='TabAgenda' class='table table-bordered table-hover'> ";
$tbl .= "<thead><tr> 
  <th>RESIDENTE</th>
  <th>AREA COMUN</th>
  <th>FECHA RESERVA</th>
  <th>HORARIO</th>
  <th>COMPROBANTE PAGO</th>
  <th>STATUS</th>
  <th>ELIMINAR</th>
  </tr></thead>";

foreach ($rows as $reservaciones) {

    $id_area = $reservaciones["id_area"];
    $area_comun = $reservaciones["area_comun"];


    $id_reservaciones = $reservaciones["id_reservaciones"];
    $nombre_residente = $reservaciones["nombre_residente"];
    $area_comun = $reservaciones["area_comun"];
    $fecha_reserva = $reservaciones["fecha_reserva"];
    $horario = $reservacioneso["horario"];
    $id_comprobante_pago = $reservaciones["id_comprobante_pago"];
    $tbl .= "<tr>
    <td>$nombre_residente</td>
    <td>$area_comun</td>
    <td>$fecha_reserva</td>
    <td>$horario</td>
    <td>$id_comprobante_pago</td>
    <td>
    <button id='confirmar' class='btn btn-primary btn-block' onclick='confirmar();'>CONFIRMAR</button>
    <button id='anular' class='btn btn-primary btn-block' onclick='anular();'>ANULAR</button>
    <button id='eliminar' class='btn btn-primary btn-block' onclick='eliminar(\"$id_control_usuario\");'>ELIMINAR</button>
     </td>
    </tr>";
}
$tbl .= "</table>";
$json['Estado'] = "OK";
$json['respuesta'] = $tbl;

print_r(json_encode($json));

$mysqli->close();
