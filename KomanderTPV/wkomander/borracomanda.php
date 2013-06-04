<?php
session_start();
session_name("loginUsuario");

require 'clases/includes.php'; 
include_once('clases/_borracomanda.php');
include_once('clases/_log.php');

$borra = new _borracomanda();
$log = new _log(); 
        
echo $borra->borracomanda($_SESSION["mesa"],$_SESSION["comensal"],$_SESSION["zona"]);
$log->add_log($_SESSION["usuario"], "ANULA COMANDA", "Mesa anulada: ".$_SESSION["mesa"]." Comensal: ".$_SESSION["comensal"]);

header("Location: mesas.php");

?>
