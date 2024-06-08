<?php
//session_start();
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
$variable = $mysqli->query("SELECT * FROM `reserva`");
$rows = $variable->fetch_all(MYSQLI_ASSOC);
$tbl = "<table id='TabReservacion' class='table table-bordered table-hover'> ";
$tbl .= "<thead><tr> 
  <th>AREA COMUN</th>
  <th>FECHA_RESERVA</th>
  <th>HORARIO</th>
  <th>COMPROBANTE DE PAGO</th>
  <th>ELIMINAR</th>
  </tr></thead>";

foreach ($rows as $reserva) {
  $id_area = $reserva["id_area"];
  $area_comun = $reserva["area_comun"];
  $fecha_reserva = $reserva["reservation"];
  $horario = $reserva["horario"];
  $id_comprobante_pago = $reserva["id_comprobante_pago"];
  $tbl .= "<tr>
    <td>$area_comun</td>
    <td>$fecha_reserva</td>
    <td>$horario</td>
    <td>$id_comprobante_pago</td>

    <td>  
    <button id='eliminar' class='btn btn-primary btn-block' onclick='eliminar(\"$id_area\");'>ELIMINAR</button>
     </td>
    </tr>";
}
$tbl .= "</table>";
$json['Estado'] = "OK";
$json['respuesta'] = $tbl;

print_r(json_encode($json));

$mysqli->close();
//}
?>