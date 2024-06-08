<?php
session_start();
/*if(!isset($_SESSION['usuario']))
{
  $json['Estado'] = "ERROR";
  $json['respuesta'] = "sin token";
 print_r(json_encode($json));*/
  /*$url=`../vista/Vlogin.php`;
  echo "<script>alert('Sesión finalizada, ingrese sus datos nuevamente'); window.close();</script>";
	//echo "<script>alert('".$msj."'); window.close();</script>";
	session_destroy();
	//echo '<meta http-equiv=refresh content="1; '.$url.'">';
	die;*/
/*}
else{
  */

$mysqli = new mysqli("localhost", "root", "", "residentia");
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}
// Perform query
$variable = $mysqli->query("SELECT * FROM `alta_area`");
$rows = $variable->fetch_all(MYSQLI_ASSOC);
$tbl = "<table id='divTabAlta' class='table table-bordered table-hover'> ";
$tbl .= "<thead><tr> 
  <th>NOMBRE DESCRIPTIVO DEL AREA COMUN</th>
  <th>TIPO DE AREA COMUN</th>
  <th>CAPACIDAD MAXIMA</th>
  <th>UBICACION</th>
  <th>TARIFA DE ALQUILER</th>
  <th>ELIMINAR</th>
  </tr></thead>";

foreach ($rows as $alta_area) {
  
  $id_alta_area = $alta_area ["id_alta_area"];
  $nombre_area = $alta_area ["nombre_area"];
  $tipo_area = $alta_area ["tipo_area"];
  $capacidad = $alta_area ["capacidad"];
  $ubicacion = $alta_area ["ubicacion"];
  $tarifa_alquiler = $alta_area ["tarifa_alquiler"];
  $tbl .= "<tr>
    <td>$nombre_area</td>
    <td>$tipo_area</td>
    <td>$capacidad</td>
    <td>$ubicacion</td>
    <td>$tarifa_alquiler</td>
    <td><button id='eliminar' class='btn btn-primary btn-block' onclick='eliminar(\"$id_alta_area\");'>ELIMINAR</button></td>
    </tr>";
}
$tbl .= "</table>";
$json['Estado'] = "OK";
$json['respuesta'] = $tbl;

print_r(json_encode($json));


$mysqli->close();
//}
?>