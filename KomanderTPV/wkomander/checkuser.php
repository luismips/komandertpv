<?php
session_start();
session_name("loginUsuario");

require 'clases/includes.php';   
include_once('clases/_log.php');

$log = new _log(); 

 $bd=Db::getInstance();
$ssql = "SELECT * FROM usuarios WHERE nick='".$_POST['usuario']."' 
    and pass='".$_POST['contrasena']."'";

$stmt=$bd->ejecutar($ssql);

$sql = "";

if ( $stmt !== false && mysql_num_rows($stmt) > 0 ) {
    
   
    $log->add_log($_POST['usuario'], "ACCESO", "Desde pantalla seleccion usuarios");
    $_SESSION["autentificado"] = "SI"; //AUTENTIFICADO!!
    $_SESSION["usuario"] = $_POST['usuario'];//GUARDA USUARIO
    $_SESSION["unico"] = "N";               //GUARDA COMO UNICO = S
    $_SESSION["nivel"] = $_POST['nivel'];              
    $_SESSION["tipo"] = "usuario"; //para saber si es cliente o usuario en _articulos.php 
    $sql = "OK";
    


            
}else{
    
    $sql = "KO";
    
}


echo $sql;
?> 