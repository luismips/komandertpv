<?php

include ("../seguridad.php");
require '../clases/includes.php';
require '../clases/_comanda.php';
include '../lang/'.$_SESSION["lang"].'.php';

$c = new _comanda();

echo $c->g_info($_SESSION["mesa"], $_SESSION["comensal"]);
?>
