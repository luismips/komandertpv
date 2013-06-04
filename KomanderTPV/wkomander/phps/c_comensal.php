<?php
include ("../seguridad.php");
require '../clases/includes.php';

$bd=Db::getInstance();

$sql = "";

$_SESSION['mesa'] = $_POST['nombre'];

$ssql = "SELECT comensal FROM historial_puntos WHERE punto = '".$_POST['nombre']."' AND
    cobrada = 'N' AND anulado = 'N'";

$rs =$bd->ejecutar($ssql);

if ( $rs !== false && mysql_num_rows($rs) > 1) {
     $sql = "S";
}else if ( $rs !== false && mysql_num_rows($rs) == 1) {
     while ($a=$bd->obtener_fila($rs,0)){
         $_SESSION['comensal'] = $a["comensal"];
         $sql = $a["comensal"];
     }
}

echo $sql;

?> 
