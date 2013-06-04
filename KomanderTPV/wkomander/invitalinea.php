<?php
include ("seguridad.php");
header('Content-type: text/html; charset=iso-8859-1');
require 'clases/includes.php';
$bd=Db::getInstance(); 
$ssql="UPDATE historial_puntos_descr SET pvp=0.00 WHERE id_hist_descr=".$_GET["idhist"];

$bd->actualizar($ssql);

header("Location: comanda.php?mesa=".$_GET["mesa"]."&comensal=".$_GET["comensal"]."&padre=0");

?> 
