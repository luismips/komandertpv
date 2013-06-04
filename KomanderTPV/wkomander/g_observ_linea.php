<?php

header('Content-type: text/html; charset=iso-8859-1');

require 'clases/includes.php';

$bd=Db::getInstance(); 

$texto = "";

$ssql="SELECT observ FROM historial_puntos_descr WHERE id_hist_descr=".$_GET["idhist"];

 $rs = $bd->ejecutar($ssql);
     
    if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
       while ( $b = $bd->obtener_fila($rs,0)){
               
              $texto = $b["observ"];
            }
       }
      
 echo $texto;

?>
