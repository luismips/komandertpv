<?php

/**
 * Description of _comanda
 *
 * @author luismips
 */
class _comanda {
    
       
    public function g_comanda($mesa, $comensal) {
         include_once('../clases/conexion.php');
         $bd=Db::getInstance(); 
         $datos = new conexion();

        $hist = new _i_historial();
        
        $id_hist = $hist->g_id_hist($mesa, $comensal);
        
        $idioma = "";
        $otro_idioma =false;
        
        if ($_SESSION["lang"] != $_SESSION["idioma_local"]){
            $idioma="_".$_SESSION["lang"];
            $otro_idioma = true;
        }
        
        $ssql = "SELECT * FROM historial_puntos_descr 
            INNER JOIN historial_puntos ON
            historial_puntos_descr.id_hist_punto = historial_puntos.id_hist
            
            WHERE id_hist_punto = '".$id_hist."' AND historial_puntos_descr.anulado ='N'  
                    ORDER BY historial_puntos_descr.id_hist_descr DESC";
        
        $rs = $bd->ejecutar($ssql);
        

        $sql = "";
        $info = "";
        
        if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
            
           

           $sql .= "<div id=\"comanda\">";
           
           $sql .= "<table id=\"tb_comanda\">";
           $sql .= '<thead>
		<tr>
                        
			<th scope="col">'.CLIM_UDS.'</th>
			<th scope="col">'.CLIM_ARTICULO.'</th>
			<th scope="col">'.CLIM_SUMA.'</th>
		</tr>
	 </thead>';
           $suma = 0.00;
           $total = 0.00;
           $avg_propina = 0.00;
           $avg_descuento = 0.00;
           
           $servido = "";
           $entregado = "";
           
            while ( $a = $bd->obtener_fila($rs,0)){
                
                $mods_lang = "";
           
               if ($otro_idioma){
                   $mods_lang = $a["mods_lang"];
               }else{
                   $mods_lang = $a["mods"];
               }
                $nombre_art = "";
                
                $nomb = "SELECT nombre".$idioma." AS nombre FROM articulos WHERE id_articulo = ".$a["idarticulo"];
                $rs4 = $bd->ejecutar($nomb);
                if ( $rs4 !== false && mysql_num_rows($rs4) > 0 ) {
                    while ( $s = $bd->obtener_fila($rs4,0)){
                        
                        $nombre_art = $s['nombre'];
                    }
                }
                
                
                $serv = "SELECT servido, entregado FROM cola WHERE id_hist_descr = ".$a['id_hist_descr'];
                $rserv = $bd->ejecutar($serv);
                if ( $rserv !== false && mysql_num_rows($rserv) > 0 ) {
                    while ( $s = $bd->obtener_fila($rserv,0)){
                        $servido = $s['servido'];
                        $entregado = $s['entregado'];
                    }
                }
                               
                $color = "";
                               
                    if ($servido == 'S'){
                        $color="verde";
                        $bEntr = "<td></div></td>";
                    }else{
                        $color="normal";
                        $bEntr = "<td></td>";
                    }
                    
                    if ($entregado == 'S'){
                        $color="entregado";
                        $bEntr = "<td></td>";
                    }
                    
              
               
                
                
                  if ($a["enviado"]== "S"){  
                    
                        $sql .= "<tr class=\"".$color."\">";
//                        $sql .= $bEntr;
                        $sql .= "<td>".preg_replace('/^(\d+)\.0+$/', '$1', $a['cantidad'])."</td>";
                        $sql .= "<td>".stripslashes($nombre_art)." ".$mods_lang."</td>";
                        
                        
                    
                  }else{
                    $sql .= "<tr class=\"".$color."\">";
                    
//                    $sql .= $bEntr;
                    $sql .= "<td>".preg_replace('/^(\d+)\.0+$/', '$1',$a['cantidad'])."</td>";
                     $sql .= "<td onclick=borralinea(".$a['id_hist_descr'].",'".$a['enviado']."')>".stripslashes($nombre_art)." ".$mods_lang."</td>";
                  }
                  
                
                $sql .= "<td>".$datos->knumber($a['pvp'])."</td></tr>";
               
            }
               

            $sql .= "</table>";
            $sql .= "</div>";
            
           
            

    }

        return $sql;
    }
    
    
    public function g_info($mesa, $comensal) {
         include_once('../clases/conexion.php');
         $bd=Db::getInstance(); 
         $datos = new conexion();
   
        $hist = new _i_historial();
        
        $id_hist = $hist->g_id_hist($mesa, $comensal);
        
        $ssql = "SELECT * FROM historial_puntos_descr INNER JOIN historial_puntos ON
            historial_puntos_descr.id_hist_punto = historial_puntos.id_hist
            WHERE id_hist_punto = '".$id_hist."' AND historial_puntos_descr.anulado = 'N'  
                    ORDER BY historial_puntos_descr.id_hist_descr DESC";
        $rs = $bd->ejecutar($ssql);
        

//        $sql = "";
        $info = "";
        
        if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
    
           $info .= "<div id=\"container_info\">";
           
           
           
           $info .="<table id=\"tabla_info\">";
           $info .= "<tr class=\"avg\"><td>".CLIM_MESA.":</td><td>".$mesa."</td>";
           $info .= "<td class=\"avg\">".CLIM_COMENSAL.":</td><td>".$comensal."</td>";
          
           $suma = 0.00;
//           $total = 0.00;
           $avg_propina = 0.00;
           $avg_descuento = 0.00;
           
           
            while ( $a = $bd->obtener_fila($rs,0)){
               $suma = $suma + (stripslashes($a['pvp']));// * stripslashes($a['cantidad']));
               $avg_propina = $a['propina'];
               $avg_descuento = $a['descuento'];
               
            }
                        
            $propina = ($suma * $avg_propina)/100;
            
            //actualizar propina y descuento en historial_puntos
            $total = $suma + (($suma * $avg_propina)/100) - (($suma * $avg_descuento)/100);
            $info .= "<td>".CLIM_SUMA.":</td><td id=\"ttotal\">".$datos->knumber($suma)."</td><td>".CLIM_PROPINA.":</td><td>".$datos->knumber($propina)."</td><td>".CLIM_TOTAL.":</td><td>".$datos->knumber($total)."</td></tr></table>";
            $info .= "</div>";
            
          
            

        }

        return $info;
    }
    


}

?>
