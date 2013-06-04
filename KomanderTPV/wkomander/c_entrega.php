<?php
 session_start();
 session_name("loginUsuario");
 
header('Content-type: text/html; charset=iso-8859-1');
require 'clases/includes.php';
$bd=Db::getInstance();
$por_entregar = 'N';
 //para saber si tienen algo pendiente de entrega en la mesa y ke aparezca de otro color
                    $ssql = "SELECT entregado FROM cola INNER JOIN historial_puntos_descr ON
                                cola.id_hist_descr = historial_puntos_descr.id_hist_descr 
                                INNER JOIN historial_puntos ON historial_puntos_descr.id_hist_punto = 
                                historial_puntos.id_hist
                                
                                WHERE historial_puntos.usuario = '".$_SESSION["usuario"]."' AND 
                                    historial_puntos.cobrada = 'N' AND 
                                historial_puntos.anulado = 'N' AND cola.servido = 'S' AND
                                    cola.entregado = 'N'";
                    
                             $rs = $bd->ejecutar($ssql);
                             
                             if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
                                  $por_entregar = 'S';
                             }
echo $por_entregar;

?> 




















