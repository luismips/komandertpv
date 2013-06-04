<?php
//if ($_GET["usuario"]!="cliente"){
//    session_start();
//    session_name("loginUsuario");
//}else{
    session_start();
//    session_name("cliente");
//}

require 'clases/includes.php';

include_once('clases/_check_mods.php');
$m = new _check_mods();
echo $m->procesa_mod($_POST['mod']);

?>
