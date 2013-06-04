<?php
include ("../seguridad.php");

$_SESSION["comensal"]= $_POST["comensal"];

header("Location: ../comanda.php");
?> 