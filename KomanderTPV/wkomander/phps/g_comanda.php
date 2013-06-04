<?php

include ("../seguridad.php");
header('Content-type: text/html; charset=iso-8859-1');
require '../clases/includes.php';
require '../clases/_comanda.php';
include '../lang/'.$_SESSION["lang"].'.php';

$c = new _comanda();

echo $c->g_comanda($_SESSION["mesa"], $_SESSION["comensal"]);
?>
