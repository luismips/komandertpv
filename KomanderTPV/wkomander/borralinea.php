<?php
include ("seguridad.php");
header('Content-type: text/html; charset=iso-8859-1');

require 'clases/includes.php';
include_once('clases/_log.php');

 $bd=Db::getInstance();  
 $log = new _log(); 


    if ($_GET["enviado"]=="N"){
        $ssql = "DELETE FROM historial_puntos_descr  
        WHERE id_hist_descr = ".$_GET["idlinea"];
        $bd->actualizar($ssql);

    }else{
        $ssql = "UPDATE historial_puntos_descr SET anulado = 'S' 
        WHERE id_hist_descr = ".$_GET["idlinea"];

        $bd->actualizar($ssql);

        $log->add_log($_SESSION["usuario"], "ANULA LINEA", "Linea anulada: ".$_GET["idlinea"]);

        $ssql = "UPDATE cola SET anulado = 'S' 
            WHERE id_hist_descr = ".$_GET["idlinea"];

        $bd->actualizar($ssql);
    }

   header("Location: comanda.php");
?>

