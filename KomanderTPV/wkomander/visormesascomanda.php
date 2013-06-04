<?php
 session_start();
 session_name("loginUsuario");
header('Content-type: text/html; charset=iso-8859-1');
include 'lang/'.$_SESSION["lang"].'.php';
require 'clases/includes.php';
$bd=Db::getInstance(); 
$sql = "";

$ssql = "SELECT articulos.nombre_".$_SESSION["lang"]." AS articulo,
    familias.preferencia, cola.llevar, cola.id_cola, cola.hora_recibo, cola.uds, 
               cola.mods, cola.observ, cola.mesa, cola.comensal, cola.usuario, cola.servido, cola.anulado,
               cola.traspaso, cola.punto_anterior  FROM relacion_visores_cola 
                    INNER JOIN cola ON relacion_visores_cola.id_cola=cola.id_cola
                    INNER JOIN historial_puntos_descr ON cola.id_hist_descr = historial_puntos_descr.id_hist_descr 
                    INNER JOIN historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
    
                    INNER JOIN visores ON relacion_visores_cola.id_visor=visores.id_visor
                    INNER JOIN articulos ON cola.articulo = articulos.id_articulo 
                    INNER JOIN familias ON articulos.id_familia = familias.id_familia

                    WHERE visores.id_visor=".$_GET["visor"]." AND 
                        historial_puntos.punto ='".str_replace("%20", " ",$_GET["mesa"])."' AND 
                        historial_puntos.cobrada = 'N' AND historial_puntos.anulado = 'N' 
                        ORDER BY cola.servido ASC, familias.preferencia ASC, cola.id_cola ASC";

// ORDER BY cola.servido ASC, cola.id_cola ASC";


$rs = $bd->ejecutar($ssql);

$sql .= '<tr><td id="td_mesa" colspan=5>MESA: '.str_replace("%20", " ", $_GET["mesa"]).'</td> </tr>
    
                <tr>
                        <td id="g2_serv"SER</td>
			<td id="g2_hora">'.HORA.'</td>
                        <td id="g2_uds">'.UDS.'</td>
			<td id="g2_art">'.ARTICULO.'</td>
                        <td id="g2_com">COM</td>
			
                        
		</tr>';

if ( $rs !== false && mysql_num_rows($rs) > 0 ) { 
    
    $idcola = "";
    
    
        while ( $a = $bd->obtener_fila($rs,0)){
            
             if ($idcola != stripslashes($a['id_cola']) ) {  //para ke no se repita la id cola
                                                            //en el caso de los traspasos
               $mods = "";                                
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
                 
                 
                 $hora = substr($a['hora_recibo'],0, strlen($a['hora_recibo'])-3);                                            //en el caso de los traspasos
               $llevar = stripslashes($a['llevar']);
                 $servido = stripslashes($a['servido']);
                $anulado = stripslashes($a['anulado']);
                $traspaso = stripslashes($a['traspaso']);
                $color = "normal";
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
                
                $sql .= "<tr class=\"".$color."\">";
                                
                if ($_SESSION["nivel"]=="administrador" || $_SESSION["nivel"]=="encargado" || $_SESSION["nivel"]=="visor"){
                    $sql .= "<td id=\"".stripslashes($a['id_cola'])."\" class=\"g2_serv\" onclick=servido(".$a['id_cola'].")>";
                }else{
                    $sql .= "<td id=\"".stripslashes($a['id_cola'])."\">";
                }
                
                $sql.= '<td class="g2_hora">'.$hora.'</td>';    
                $sql.= '<td class="g2_uds">'.preg_replace('/^(\d+)\.0+$/', '$1',$a["uds"]).'</td>';

                $sql.= '<td class="g2_art">'.$a["articulo"]. " " .$mods." " .$a["observ"].'</td>';
                $sql.= '<td class="g2_com">'.$a["comensal"].'</td>';

                    
                
                $sql.= '</tr>';
                
                $idcola =  stripslashes($a['id_cola']); 
                
             }
            
            
        }
     echo $sql;

}else{
        echo 'NO';
}


?> 
