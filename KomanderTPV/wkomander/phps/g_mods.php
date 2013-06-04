<?php

include ("../seguridad.php");
header('Content-type: text/html; charset=iso-8859-1');
require '../clases/includes.php';
require '../clases/_mods.php';
include '../lang/'.$_SESSION["lang"].'.php';

$c = new _mods();

echo $c->g_mods($_SESSION["grupomods"], $_SESSION["idarticulo"]);

?>