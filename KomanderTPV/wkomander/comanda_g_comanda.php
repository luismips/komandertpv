<?php
include ("seguridad.php");
header('Content-type: text/html; charset=iso-8859-1');
 include_once('clases/_comanda.php');
  include 'lang/'.$_SESSION["lang"].'.php';
    require 'clases/includes.php'; 
        
$com = new _comanda();

echo $com->g_comanda($_SESSION["mesa"], $_SESSION["comensal"]);

?>
