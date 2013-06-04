<?php

include ("../seguridad.php");
header('Content-type: text/html; charset=iso-8859-1');
require '../clases/includes.php';
require '../clases/_articulos.php';
include '../lang/'.$_SESSION["lang"].'.php';

$c = new _articulos();

$_SESSION['padre'] = $_POST["padre"];

echo $c->g_familias($_POST["padre"]);

?>
