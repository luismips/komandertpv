<?php
include ("seguridad.php");
require 'clases/includes.php';
require 'clases/_usuarios.php';

$usr = new _usuarios();

$usr->cambio_camarero($_GET["n"], $_SESSION["mesa"]);

 header("Location: mesas.php");
?>
