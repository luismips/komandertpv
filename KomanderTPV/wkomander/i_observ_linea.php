<?php

header('Content-type: text/html; charset=iso-8859-1');
require 'clases/includes.php';

$bd=Db::getInstance(); 

$ssql="UPDATE historial_puntos_descr SET observ='".str_replace("%20", " ", $_GET["observ"])."' WHERE id_hist_descr=".$_GET["idhist"];

$bd->actualizar($ssql);

$ssql="UPDATE cola SET observ='".str_replace("%20", " ", $_GET["observ"])."' WHERE id_hist_descr=".$_GET["idhist"];

$bd->actualizar($ssql);

?> 
