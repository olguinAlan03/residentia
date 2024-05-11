<?php
$constante = $_GET["nombre"];
$constante2 = $_GET["pass"];
session_start();

$mysqli = new mysqli("localhost","root","","test");
//print_r($constante);
// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
// Perform query Login original 
/*$variable = $mysqli -> query("SELECT count(id_usuario) as veces,
if(count(id_usuario)=1,'YES','NO') as razon FROM `registro`
where nombre = '".$constante."' and pass='".$constante2."';");
$rows = $variable->fetch_all(MYSQLI_ASSOC);*/

// Permiso de rol
$variable = $mysqli -> query("SELECT * FROM `registro` WHERE `nombre`= '".$constante."' and `pass`= '".$constante2."';");
$rows = $variable->fetch_all(MYSQLI_ASSOC);
foreach ($rows as $row) {
  $id_usuario = $row["id_usuario"];
  $nombre = $row["nombre"];
  $rol= $row ["permiso"];
  $pass = $row["pass"];
}


$_SESSION["usuario"]=$constante;

$json['Estado']= "OK";
$json['id_usuario'] = $id_usuario; 
$json['usuario'] = $nombre;
$json['permiso'] = $rol; 
$json['pass'] = $pass; 


print_r(json_encode($json));
//echo $rows[0]["razon"];
$mysqli -> close();
?>