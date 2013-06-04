<?php
include ("../seguridad.php");
require '../clases/includes.php';

$_SESSION["mesa"]= $_POST["nombre"];


$bd=Db::getInstance();

//$sql = "";

$ssql = "SELECT comensal FROM historial_puntos WHERE punto = '".$_POST['nombre']."' AND
    cobrada = 'N' AND anulado = 'N'";

$rs =$bd->ejecutar($ssql);

if ( $rs !== false && mysql_num_rows($rs) > 1) {
//    $sql = "S";
      header("Location: ../comensales.php");
}else{

//else if ( $rs !== false && mysql_num_rows($rs) == 1) {
//     while ($a=$bd->obtener_fila($rs,0)){
//         $sql = $a["comensal"];
//     }
        header("Location: ../comanda.php");
     
}


?> 