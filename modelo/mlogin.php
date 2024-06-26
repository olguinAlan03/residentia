<?php
$constante = $_GET["claveR"];
$constante2 = $_GET["pass"];
session_start();
$mysqli = new mysqli("localhost", "root", "", "residentia");
/*$nombre=$_SESSION["usuario"];
$nombre=strtoupper($nombre);*/
//print_r($constante);
// Check connection
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}
// Perform query

$variable = $mysqli->query("SELECT count(usuarios_pag.id_usuario) as veces, if(count(usuarios_pag.id_usuario)=1,'YES','NO') 
as razon, residente.id_residente, residente.nombre, residente.apellido_paterno, residente.apellido_materno, residente.telefono
FROM `usuarios_pag` 
INNER JOIN residente ON usuarios_pag.id_residente = residente.id_residente 
where usuarios_pag.id_residente = ".$constante." and usuarios_pag.passwor='".$constante2."';");
$rows = $variable->fetch_all(MYSQLI_ASSOC);

/*foreach ($rows as $row) {
  $id_residente = $row["id_residente"];
  //$nombre = $row["nombre"];
  $rol= $row ["id_rol"];
  $pass = $row["passwor"];
}*/


//$sql = "SELECT u.id, r.name AS role,'pass' FROM users u INNER JOIN roles r ON r.id = u.role_id WHERE nombreUsuario = '$constante';";
// Conectar a la base de datos
//foreach ($rows as $row) {
//$id_user=$row["id_user"];
//$username=$row["username"];
//print_r($row["razon"]);
//print_r (" id usuario ".$id_user." nombre del usuario ".$username);
//echo "\n";
//}
//get traspasa informacion por URL
//post
/*$myObj->respuesta = $rows[0]["razon"];
$myJSON = json_encode($myObj);
print_r($myJSON);*/

//-------------------------
/*if (password_verify($result['pass'], password_hash($constante2, PASSWORD_BCRYPT))) {
  $startingPage = [
     'Administrador' => 'vMenu.php',
     'Cliente' => 'vUsuario.php',
  ];
  $nextPage = array_key_exists($result['permiso'], $startingPage) ? $startinPage['permiso'] : 'vUsuario.php';
  if (array_key_exists($result['permiso'], $startingPage)) {
     $nextPage = $startinPage[$result['permiso']];
  } else {
     $nextPage = $startinPage['user'];
     error_log('There is no starting page for role '.$result['permiso']);
  }
  session_start();
  $_SESSION['idUsuario'] = $result['id'];
  $_SESSION['permiso'] = $result['permiso'];
  header('Location: '.$nextPage);
} else {
  header('Location: vlogin.php');
}*/

$_SESSION['idResidente'] = $rows[0]["id_residente"];
$_SESSION['residente'] = $rows[0]["nombre"];
$_SESSION['apP_Residente'] = $rows[0]["apellido_paterno"];
$_SESSION['apM_Residente'] = $rows[0]["apellido_materno"];
$_SESSION['telefono'] = $rows[0]["telefono"];
$json['Estado'] = "Ok"; 
$json['respuesta'] = $rows[0]["razon"];

print_r(json_encode($json)); //echo $rows[0]["razon"];
$mysqli->close();
?>