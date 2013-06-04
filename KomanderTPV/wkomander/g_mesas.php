<?php
include ("seguridad.php");
header('Content-type: text/html; charset=iso-8859-1');
include_once('clases/_mesas.php');
include 'lang/'.$_SESSION["lang"].'.php';
require 'clases/includes.php'; 
        
$mes = new _mesas();
$_SESSION["zona"] = $_POST["zona"];
$_SESSION["tipo_zona"] = $_POST["tipo"];
echo $mes->g_mesas($_POST["zona"],$_POST["tipo"]);

?>