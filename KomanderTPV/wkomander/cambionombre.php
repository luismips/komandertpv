<?php
include ("seguridad.php");
require 'clases/includes.php';
include_once('clases/_cambionombre.php');

$cambio = new _cambionombre();

$cambio->cambio_nombre($_SESSION["mesa"],$_SESSION["comensal"], $_GET["nuevo"]);

 header("Location: comanda.php");



?>
