<?php
$constante = $_GET["user"];
$constante2 = $_GET["pass"];

$mysqli = new mysqli("localhost","root","","residentia");
//print_r($constante);
// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
// Perform query
$variable = $mysqli -> query("SELECT count(id_usuario) as veces,
if(count(id_usuario)=1,'YES','NO') as razon FROM `usuario`
where nombre = '".$constante."' and contraseña='".$constante2."';");
$rows = $variable->fetch_all(MYSQLI_ASSOC);
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

$json['Estado']= "OK";
$json['respuesta'] = $rows[0]["razon"];

print_r(json_encode($json));
//echo $rows[0]["razon"];
$mysqli -> close();
?>