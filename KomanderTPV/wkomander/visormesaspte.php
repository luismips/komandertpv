<?php
header('Content-type: text/html; charset=iso-8859-1');
 require 'clases/includes.php';
 
$bd=Db::getInstance(); 

$sql = "";
        
$ssql="SELECT DISTINCT historial_puntos.punto, historial_puntos.hora_apertura FROM relacion_visores_cola 
            INNER JOIN cola ON relacion_visores_cola.id_cola=cola.id_cola
            INNER JOIN historial_puntos_descr ON cola.id_hist_descr = historial_puntos_descr.id_hist_descr 
            INNER JOIN historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
    
            INNER JOIN visores ON relacion_visores_cola.id_visor=visores.id_visor
            WHERE visores.id_visor=".$_GET["visor"]." AND 
                cola.servido='N' AND 
                historial_puntos.cobrada = 'N' AND historial_puntos.anulado = 'N' 
                ORDER BY historial_puntos.id_hist ASC";

$rs = $bd->ejecutar($ssql);
        
if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
    
    $mesa = "";
     while ( $a = $bd->obtener_fila($rs,0)){
           if ($mesa != $a["punto"]){
               $hora = substr($a['hora_apertura'],0, strlen($a['hora_apertura'])-3);
               $sql .= '<div class="mesa" onclick=comandamesa(\''.str_replace(" ", "%20", $a["punto"]).'\')>';
               $sql .= '<p id="p_punto">'.$a["punto"]."</p>";
               $sql .= '<p id="p_hora">'.$hora."</p>";
               $sql .= "</div>";  
               $mesa = $a["punto"];
            }
     }
}else{
  $sql="NO";
}
       
echo $sql;
    
    
?>
