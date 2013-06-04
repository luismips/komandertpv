<?php
session_name("loginUsuario");
session_start();
session_destroy();
header ("Location: acceso.php");
?>
 