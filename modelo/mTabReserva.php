<?php
$mysqli = new mysqli("localhost", "root", "", "test");
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}
// Perform query
$variable = $mysqli->query("SELECT * FROM `prueba`");
$rows = $variable->fetch_all(MYSQLI_ASSOC);
$tbl = "<table id='divTablaR' class='table table-bordered table-hover'> ";
$tbl .= "<thead><tr> 
<th>AREA COMÚN</th>
  <th>FECHA</th>
  <th>NOMBRE PRIVADA</th>
  <th>TELEFONO</th>
  <th>ELIMINAR</th>
  </tr></thead>";

 


foreach ($rows as $prueba) {
  $id_prueba = $prueba["id_prueba"];
  $area = $prueba["area"];
  $fecha = $prueba["fecha"];
  $privada = $prueba["privada"];
  $telefono = $prueba["telefono"];
  $tbl .= "<tr>
    <td>$area</td>
    <td>$fecha</td>
    <td>$privada</td>
    <td>$telefono</td>

    <td>  
    <button id='eliminar' class='btn btn-primary btn-block' onclick='eliminar(\"$id_prueba\");'>ELIMINAR</button>
     </td>
    </tr>";
}
$tbl .= "</table>";
$json['Estado'] = "OK";
$json['respuesta'] = $tbl;

print_r(json_encode($json));

$mysqli->close();
?>