<?php
include ("../seguridad.php");
require '../clases/includes.php';
require '../clases/_mesas.php';

$m = new _mesas();

echo $m->g_comensales($_SESSION["mesa"]);



?> 