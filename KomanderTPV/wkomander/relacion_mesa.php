<?php
 session_start();
 session_name("loginUsuario");
header('Content-type: text/html; charset=iso-8859-1');
require 'clases/includes.php';
 include 'lang/'.$_SESSION["lang"].'.php';
$bd=Db::getInstance(); 

$sql = "";


$ssql="SELECT articulos.nombre_".$_SESSION["lang"]." AS articulo,
    familias.preferencia, cola.llevar, cola.id_cola, cola.hora_recibo, cola.uds,
               cola.mods, cola.observ, cola.mesa, cola.comensal, cola.usuario, cola.servido, cola.anulado,
               cola.traspaso, cola.punto_anterior FROM relacion_visores_cola 
                    INNER JOIN cola ON relacion_visores_cola.id_cola=cola.id_cola
                    INNER JOIN historial_puntos_descr ON cola.id_hist_descr = historial_puntos_descr.id_hist_descr 
                    INNER JOIN historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
    
                    INNER JOIN visores ON relacion_visores_cola.id_visor=visores.id_visor
                    INNER JOIN articulos ON cola.articulo = articulos.id_articulo 
                    INNER JOIN familias ON articulos.id_familia = familias.id_familia

                    WHERE visores.id_visor=".$_GET["visor"]." AND 
                        historial_puntos.punto ='".str_replace("%20", " ",$_GET["mesa"])."' AND 
                        historial_puntos.cobrada = 'N' AND historial_puntos.anulado = 'N' 
                        GROUP BY relacion_visores_cola.id_cola 
                        ORDER BY cola.servido ASC, familias.preferencia";


$rs = $bd->ejecutar($ssql);

$sql .= '<tr><td colspan=2>MESA: '.str_replace("%20", " ", $_GET["mesa"]).'</td> </tr>
    
                <tr>
			
                        <td id="g2_uds">'.UDS.'</td>
			<td class="g1_mesa">'.ARTICULO.'</td>
			
                        
		</tr>';

if ( $rs !== false && mysql_num_rows($rs) > 0 ) { 
    
    $idcola = "";
    
    
        while ( $a = $bd->obtener_fila($rs,0)){
            
             if ($idcola != stripslashes($a['id_cola']) ) {  //para ke no se repita la id cola
                     $mods = "";                                //en el caso de los traspasos
              //obtener mods en el idioma elegido
              if ($a["mods"]!=""){
                  $ids = explode(" ", $a["mods"] );
                  foreach ($ids as $id)

                    {
                      $serv = "SELECT nombre_".$_SESSION["lang"]." AS nombre
                          FROM modificadores WHERE id_modificador = ".$id;
                       $stmtserv=$bd->ejecutar($serv); 
                       if ($stmtserv !== false && mysql_num_rows($stmtserv) > 0) {
                             while ($s=$bd->obtener_fila($stmtserv,0)){
                                $mods .= $s['nombre']. " ";
                               
                            }
                        }
                    }

              }
                 

               $llevar = stripslashes($a['llevar']);
                 $servido = stripslashes($a['servido']);
                $anulado = stripslashes($a['anulado']);
                $traspaso = stripslashes($a['traspaso']);
                $color = "";
                $preferencia = stripslashes($a['preferencia']);
                
                if ($anulado == 'S'){
                    $color = "rojo";
                    
                }else{
                    
                    if ($llevar=='S'){
                        $color="llevar";
                    }
                    
                    if ($preferencia < "3"){
                        $color="primeros";
                    }
                    
                    if ($servido == 'S'){
                        $color="verde";
                    }
                }
               
                if ($_SESSION["nivel"]=="administrador" || $_SESSION["nivel"]=="encargado" || $_SESSION["nivel"]=="visor"){
                    $sql .= "<tr id=\"".stripslashes($a['id_cola'])."\" class=\"".$color."\" onclick=servido(".$a['id_cola'].")>";
                }else{
                    $sql .= "<tr id=\"".stripslashes($a['id_cola'])."\" class=\"".$color."\">";
                }
                $sql.= '<td>'.preg_replace('/^(\d+)\.0+$/', '$1',$a["uds"]).'</td>';
                $sql.= '<td>'.$a["articulo"]. " " .$mods." " .$a["observ"].'</td>';
                $sql.= '</tr>';
                
                $idcola =  stripslashes($a['id_cola']); 
                
             }
            
            
        }
        echo $sql;

}else{
        echo 'NO';
}

?> 
