<?php
 include ("../seguridad.php");
header('Content-type: text/html; charset=iso-8859-1');
require '../clases/includes.php';

$bd=Db::getInstance();

$ssql= "UPDATE puntos SET pos_x =".$_GET['posx'].", pos_y =".$_GET['posy']." WHERE nombre = '".$_GET['nombre']."'";
$bd->ejecutar($ssql); 

     


?>
