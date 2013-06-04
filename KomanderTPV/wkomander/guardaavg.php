<?php
require 'clases/includes.php';

$bd=Db::getInstance(); 

$ssql = "UPDATE historial_puntos SET propina = ".$_GET['propina'].", 
    descuento = ".$_GET['descuento']." WHERE punto = '".$_GET['mesa']."' AND 
 comensal = '".$_GET['comensal']."' AND cobrada = 'N' AND anulado = 'N'";

$bd->actualizar($ssql);

header("Location: comanda.php?mesa=".$_GET['mesa']."&comensal=".$_GET['comensal']."&padre=0");


?> 