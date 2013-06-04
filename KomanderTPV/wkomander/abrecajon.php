<?php
session_start();
session_name("loginUsuario");
if (($_SESSION["nivel"] == "administrador") || ($_SESSION["nivel"]== "encargado")){
    $cmd ="type c:\apertura.txt > lpt1";
    exec($cmd);
} 
header ("Location: mesas.php?zona=".$_SESSION["zona"]);
?>
