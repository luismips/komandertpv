<?php
header('Content-type: text/html; charset=iso-8859-1');
session_start();
session_name("cliente"); 
require '../clases/includes.php';
  
include_once('../clases/_log.php');
$bd=Db::getInstance(); 
$log = new _log(); 

if ($_GET["enviado"]=="N"){
    $ssql = "DELETE FROM historial_puntos_descr  
    WHERE id_hist_descr = ".$_GET["idlinea"];
    $bd->borrar($ssql);

    $log->add_log($_SESSION["usuario"], "CLIENTE ELIMINA LINEA", "Mesa: ".$_SESSION["mesa"]);
}

header("Location: comandacli.php");//?mesa=".$_GET["mesa"]."&comensal=".$_GET["comensal"]."&padre=0");
?>

