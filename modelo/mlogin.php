<?php
$constante = $_GET ["id_residente"];
$constante2 = $_GET ["usuario"];
$constante3 = $_GET["password"];
session_start();

/*if(!isset($_SESSION['usuario']))
{
  $json['Estado'] = "ERROR";
  $json['respuesta'] = "sin token";
 print_r(json_encode($json));
  $url='../vista/Vlogin.php';
  echo "<script>alert('Sesión finalizada, ingrese sus datos nuevamente'); window.close();</script>";
	//echo "<script>alert('".$msj."'); window.close();</script>";
	session_destroy();
	//echo '<meta http-equiv=refresh content="1; '.$url.'">';
	die;
}
else{*/



//include 'connexin.php';

$mysqli = new mysqli("localhost","root","","residentia");// TODO hacer una sola clase para todos los modelos
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
$variable = $mysqli -> query("SELECT * FROM `usuarios_pag` WHERE `id_residente`= ('".$constante."' or `usuario`= '".$constante2."') and `password`= '".$constante3."';");
$rows = $variable->fetch_all(MYSQLI_ASSOC);
if ($rows->num_rows > 0) {
  foreach ($rows as $row) {
    $id_residente = $row["id_residente"];
    $usuario = $row["usuario"];
    //$rol= $row ["id_rol"];
    $pass = $row["password"];
  }
  
  
  $_SESSION["nombre"]=$constante;
  $_SESSION["idResidente"]=$id_residente;
  
  
  $json['Estado']= "OK";
  $json['id_residente'] = $id_residente; 
  $json['usuario'] = $nombre;
  //$json['id_rol'] = $rol; 
  $json['password'] = $pass; 
  
  
  print_r(json_encode($json));
}

//echo $rows[0]["razon"];
$mysqli -> close();//}
?>