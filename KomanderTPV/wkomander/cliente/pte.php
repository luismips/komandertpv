<?php
session_start();
session_name("cliente");
require '../clases/includes.php';
include_once('../clases/_pte.php');
require_once("../../pdf/dompdf/dompdf_config.inc.php");

$pt = new _pte();

$pt->i_cola($_SESSION['mesa'], $_SESSION['comensal']);
 
header("Location: index.php");



?>


