<?php
include ("../seguridad.php");
require '../clases/includes.php';
require '../clases/_i_historial.php';
require '../clases/_addcomensales.php';

$c = new _addcomensales();

$c->add_comensales($_SESSION['mesa'], $_POST['num']);


?> 