<?php
header('Content-type: text/html; charset=iso-8859-1');
require 'clases/includes.php';

$bd=Db::getInstance(); 

$ssql="UPDATE cola SET entregado=IF(entregado='N','S','N') WHERE id_hist_descr=".$_GET["idhistdescr"];

$bd->actualizar($ssql);


?> 
