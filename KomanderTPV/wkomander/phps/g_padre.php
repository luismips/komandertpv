<?php

include ("../seguridad.php");
header('Content-type: text/html; charset=iso-8859-1');
require '../clases/includes.php';
require '../clases/_articulos.php';
include '../lang/'.$_SESSION["lang"].'.php';

$c = new _articulos();


echo $c->g_padre($_SESSION["padre"]);

?>