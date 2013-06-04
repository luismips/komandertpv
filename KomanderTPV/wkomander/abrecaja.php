<?php
session_start();
session_name("loginUsuario");
header('Content-type: text/html; charset=iso-8859-1');
require 'clases/includes.php';

$bd=Db::getInstance(); 

$hora = date("H:i");
$fecha = date("Y-n-j");

$ssql = "INSERT INTO caja (fecha_ini, hora_ini, fecha_fin, hora_fin, 
    total_contado, total_visa, cambio, abierta) VALUES ( 
    '".$fecha."', '".$hora."', '0000-00-00', '00:00', 
        0.00, 0.00, ".$_GET["cambio"].", 'S')";

$bd->ejecutar($ssql);

header("Location: caja.php");

?> 