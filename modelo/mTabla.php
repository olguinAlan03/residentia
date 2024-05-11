<?php
session_start();


if(!isset($_SESSION['usuario']))
{
  $json['Estado'] = "ERROR";
  $json['respuesta'] = "sin token";
 print_r(json_encode($json));
  /*$url=`../vista/Vlogin.php`;
  echo "<script>alert('Sesión finalizada, ingrese sus datos nuevamente'); window.close();</script>";
	//echo "<script>alert('".$msj."'); window.close();</script>";
	session_destroy();
	//echo '<meta http-equiv=refresh content="1; '.$url.'">';
	die;*/
}
else{

$mysqli = new mysqli("localhost", "root", "", "test");
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}
// Perform query
$variable = $mysqli->query("SELECT * FROM `control_usuario`");
$rows = $variable->fetch_all(MYSQLI_ASSOC);
$tbl = "<table id='TablaReserva' class='table table-bordered table-hover'> ";
$tbl .= "<thead><tr> 
<th>NOMBRE</th>
  <th>CORREO</th>
  <th>TELEFONO</th>
  <th>NOMBRE PRIVADA</th>
    <th>ELIMINAR</th>
  </tr></thead>";

foreach ($rows as $control_usuario) {
  $id_control_usuario = $control_usuario["id_control_usuario"];
  $nombre = $control_usuario["nombre_usuario"];
  $correo = $control_usuario["correo"];
  $telefono = $control_usuario["telefono"];
  $nombre_privada = $control_usuario["nombre_privada"];
  $tbl .= "<tr>
    <td>$nombre</td>
    <td>$correo</td>
    <td>$telefono</td>
    <td>$nombre_privada</td>

    <td>  
    <button id='eliminar' class='btn btn-primary btn-block' onclick='eliminar(\"$id_control_usuario\");'>ELIMINAR</button>
     </td>
    </tr>";
}
$tbl .= "</table>";
$json['Estado'] = "OK";
$json['respuesta'] = $tbl;

print_r(json_encode($json));

$mysqli->close();
}
?>