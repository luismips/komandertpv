<?php
session_start();
session_name("loginUsuario");
header('Content-type: text/html; charset=iso-8859-1');
require 'clases/includes.php';
include_once('clases/_caja.php');

$bd=Db::getInstance(); 
$caja = new _caja();

if (isset($_GET['forzar'])){
    $caja->forzar_reinicio();
    header("Location: index.php");
}else{

    $hora = date("H:i");
    $fecha = date("Y-n-j");
    
    $efectivo = 0.00;
    $tarjeta = 0.00;
    

    if (_DECIMALES_=="S"){
         $efectivo = $_GET["efectivo"];
        $tarjeta = $_GET["tarjeta"];
    }else{
        $efectivo = str_replace(".", "", $_GET["efectivo"]);
        $tarjeta = str_replace(".", "", $_GET["tarjeta"]);
    }
    
    $ssql="UPDATE caja SET fecha_fin= '".$fecha."', hora_fin = '".$hora."', 
        total_contado = ".$efectivo.", 
        total_visa = ".$tarjeta.", 
        abierta = 'N' WHERE id_caja = ".$_GET["idcaja"];

    $caja->reinicia_tablas();

    $bd->actualizar($ssql);

    header("Location: index.php");
}




?> 
