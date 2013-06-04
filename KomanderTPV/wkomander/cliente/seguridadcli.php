<?php
  session_start();
  session_name("cliente");

require '../clases/includes.php';


$bd=Db::getInstance(); 

$ssql = "SELECT * FROM cliente_mesa INNER JOIN puntos ON 
    cliente_mesa.id_mesa = puntos.id_punto WHERE cliente_mesa.pass = '".$_SESSION['pass']."' AND 
        puntos.nombre = '".$_SESSION['mesa']."' AND
        cliente_mesa.comensal = '".$_SESSION['comensal']."'";


    $rs = $bd->ejecutar($ssql);
    
    if ( $rs !== true && mysql_num_rows($rs) == 0 ) {
        header("Location: index.php?errorusuario=si");
     
    }

?> 