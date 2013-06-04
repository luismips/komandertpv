<?php
include ("seguridad.php");
   header('Content-type: text/html; charset=iso-8859-1');
   require 'clases/includes.php';
    
  $bd=Db::getInstance();    
  $ssql ="INSERT INTO puntos (nombre, zona, imagen, pos_x, pos_y, ocupada, 
            comensales, grupo_impresion, grupo_visor, observ, imagen_o) VALUES 
            ('".$_GET["nombre"]."', (SELECT id_zona FROM zonas WHERE tipo='LLEVAR'),
                'no', 0, 0, 'N', 0, 0, (SELECT grupo_visor FROM zonas WHERE tipo='LLEVAR'), 
                'n', 'n')";
    
  $bd->actualizar($ssql);
  
  $_SESSION["mesa"] = $_GET["nombre"];
  $_SESSION["comensal"] = "1";
  
  header("Location: comanda.php");
  
?>