<?php
session_start();
 session_name("loginUsuario");
header('Content-type: text/html; charset=iso-8859-1');
require 'clases/includes.php';
 include 'lang/'.$_SESSION["lang"].'.php';
$bd=Db::getInstance(); 

$sql = "";
$mods = "";
$nombre = "";

$ssql = "SELECT articulos.nombre_".$_SESSION["lang"]." AS nombre, 
    cola.uds, historial_puntos.punto FROM cola 
    INNER JOIN historial_puntos_descr ON cola.id_hist_descr = historial_puntos_descr.id_hist_descr 
    INNER JOIN articulos ON cola.articulo = articulos.id_articulo
    INNER JOIN historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
    WHERE cola.articulo = ".$_GET["articulo"]." AND cola.servido = 'N' AND 
        cola.anulado = 'N'";

$rs = $bd->ejecutar($ssql);

if ( $rs !== false && mysql_num_rows($rs) > 0 ) { 
        while ( $a = $bd->obtener_fila($rs,0)){
            $nombre = $a["nombre"];
            if (isset($mods[$a["punto"]])){
                      $mods[$a["punto"]] = $mods[$a["punto"]] + preg_replace('/^(\d+)\.0+$/', '$1',$a["uds"]); 
                   }else{

                    $mods[$a["punto"]] = preg_replace('/^(\d+)\.0+$/', '$1',$a["uds"]);
    
                   }
        }
        
      $sql .= '<tr><td colspan=2>'.$nombre.'</td> </tr>
          
                <tr>
			
                        <td id="g2_uds">'.UDS.'</td>
			<td class="g1_mesa">'.MESA.'</td>
			
                        
		</tr>';
        
      foreach ($mods as $clave => $valor1) {
                    
                        $sql .= '<tr onclick=relacion_mesa(\''.str_replace(" ", "%20", $clave).'\')>';
                        $sql .= "<td class=\"g2_uds\">".$valor1."</td>";
                        $sql .= "<td class=\"g2_mesa\">".$clave."</td>";
                        $sql .= "</tr>";  
                    
                }
                
       echo $sql;

}else{
        echo 'NO';
}


?> 
