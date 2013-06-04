<?php

/**
 * Description of _comanda
 *
 * @author luismips
 */
class _comanda {
    
       
    public function g_comanda($mesa, $comensal) {
         include_once('conexion.php');
         include_once('_i_historial.php');
         $datos = new conexion();

         $bd=Db::getInstance();
      
        $hist = new _i_historial();
        
         $suma = 0.00;
           $total = 0.00;
           $avg_propina = 0.00;
           $avg_descuento = 0.00;
        
        
        $id_hist = $hist->g_id_hist($mesa, $comensal);
        
        
        
        
        $ssql = "SELECT articulos.nombre_".$_SESSION["lang"]." AS articulo, 
            historial_puntos_descr.id_hist_descr, historial_puntos_descr.mods, 
            historial_puntos_descr.cantidad, historial_puntos_descr.pvp, 
            historial_puntos_descr.enviado, historial_puntos_descr.mods_lang, 
            historial_puntos_descr.idarticulo 
            FROM historial_puntos_descr 
            INNER JOIN historial_puntos ON
            historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
            INNER JOIN articulos ON 
            historial_puntos_descr.idarticulo = articulos.id_articulo
            WHERE id_hist_punto = '".$id_hist."' AND historial_puntos_descr.anulado ='N'  
                    ORDER BY historial_puntos_descr.id_hist_descr DESC";
        
        $stmt=$bd->ejecutar($ssql); 
        

        $sql = "";
        $info = "";
        
       if ($stmt !== false && mysql_num_rows($stmt) > 0) {
    

           $sql .= "<div id=\"comanda\">";
           
           $sql .= "<table id=\"tb_comanda\" >";
           $sql .= '<thead>
		<tr>
                        <th scope="col">ENTR</th>
			<th scope="col">'.UDS.'</th>
			<th scope="col">'.ARTICULO.'</th>
			<th scope="col">'.SUMA.'</th>
		</tr>
	 </thead>';
           
           
             if ($this->hay0($id_hist)) {
                 $sql .= '    <tr>
                            <td></td>
                            <td>1</td>
                            <td>'.REPARTO.'</td>
                            <td style="text-align:right;">'.$datos->knumber(_PRECIO_REPARTO_).'</td>
                    </tr>';
                 
                 
             }
          
           $servido = "";
           $entregado = "";
           
          while ($a=$bd->obtener_fila($stmt,0)){
              $articulo = $a["articulo"];

              $mods = "";  
              //obtener mods en el idioma elegido
              if ($a["mods_lang"]!=""){
                  $ids = explode(" ", $a["mods_lang"] );
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
              
              
              
                $serv = "SELECT servido, entregado FROM cola WHERE id_hist_descr = ".$a['id_hist_descr'];
                $stmtserv=$bd->ejecutar($serv); 
                if ($stmtserv !== false && mysql_num_rows($stmtserv) > 0) {
                     while ($s=$bd->obtener_fila($stmtserv,0)){
                        $servido = $s['servido'];
                        $entregado = $s['entregado'];
                    }
                }
                               
                $color = "";
                               
                    if ($servido == 'S'){
                        $color="verde";
                        $bEntr = "<td  class=\"celda_entr\"><div id=\"".$a['id_hist_descr']."celda\" class=\"botoncillo\" onclick=\"entregado(".$a['id_hist_descr'].")\"></div></td>";
                    }else{
                        $color="normal";
                        $bEntr = "<td></td>";
                    }
                    
                    if ($entregado == 'S'){
                        $color="entregado";
                        $bEntr = "<td></td>";
                    }
                    
              
               
                
                
                  if ($a["enviado"]== "S"){  
                    if ($_SESSION["nivel"]=="administrador" || $_SESSION["nivel"]=="encargado"){
                        $sql .= "<tr id=\"".$a['id_hist_descr']."\" class=\"".$color."\">";
                        
                        $sql .= $bEntr;
                        
                        
                        $sql .= "<td>".preg_replace('/^(\d+)\.0+$/', '$1', $a['cantidad'])."</td>";
                        $sql .= "<td onclick=borralinea(".$a['id_hist_descr'].",'".$a['enviado']."')>".$articulo." ".$mods."</td>";

                    }else{
                        $sql .= "<tr class=\"".$color."\">";
                        $sql .= $bEntr;
                        $sql .= "<td>".preg_replace('/^(\d+)\.0+$/', '$1', $a['cantidad'])."</td>";
                        $sql .= "<td>".$articulo." ".$mods."</td>";
                        
                        
                    }
                  }else{
                    $sql .= "<tr class=\"".$color."\">";
                    
                    $sql .= $bEntr;
                    $sql .= "<td>".preg_replace('/^(\d+)\.0+$/', '$1',$a['cantidad'])."</td>";
                     $sql .= "<td onclick=borralinea(".$a['id_hist_descr'].",'".$a['enviado']."')>".$articulo." ".$mods."</td>";
                  }
                  
                
                $sql .= "<td style=\"text-align:right;\">".$datos->knumber($a['pvp'])."</td></tr>";
               
            }
               

            $sql .= "</table>";
            $sql .= "</div>";
            
           
            

    }

        return $sql;
 }
 //comprueba si la comanda lleva el articulo 0 (reparto)
 public function hay0($hist){
     $bd=Db::getInstance();
     $sql = false;
      $repar = "SELECT historial_puntos_descr.idarticulo 
            FROM historial_puntos_descr 
            INNER JOIN historial_puntos ON
            historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
            WHERE historial_puntos_descr.idarticulo = 0 AND id_hist_punto = '".$hist."' AND historial_puntos_descr.anulado ='N'";
            $stmt2=$bd->ejecutar($repar); 
             if ($stmt2 !== false && mysql_num_rows($stmt2) > 0) {
                 $sql = true;
             }
      return $sql;
 }
 
  public function g_clave($mesa, $comensal) {
      $bd=Db::getInstance();
      $sql = "";
      $repar = "SELECT pass FROM cliente_mesa 
           WHERE id_mesa = (SELECT id_punto FROM puntos WHERE nombre ='".$mesa."') 
                   AND comensal ='".$comensal."'";
            $stmt2=$bd->ejecutar($repar); 
             if ($stmt2 !== false && mysql_num_rows($stmt2) > 0) {
                 while ($s=$bd->obtener_fila($stmt2,0)){
                     $sql = $s["pass"];
                 }
                 
             }
      return $sql;
  }
    
  
    
    
    public function g_info($mesa, $comensal) {
         include_once('conexion.php');
         include_once('_i_historial.php');
         $datos = new conexion();
//         $hist = new _i_historial();
         
        $bd=Db::getInstance();
        
        $hist = new _i_historial();
        
        $id_hist = $hist->g_id_hist($mesa, $comensal);
        
        $ssql = "SELECT * FROM historial_puntos_descr INNER JOIN historial_puntos ON
            historial_puntos_descr.id_hist_punto = historial_puntos.id_hist
            WHERE id_hist_punto = '".$id_hist."' AND historial_puntos_descr.anulado = 'N'  
                    ORDER BY historial_puntos_descr.id_hist_descr DESC";
        $stmt=$bd->ejecutar($ssql); 
        

//        $sql = "";
        $info = "";
        
        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
    
          
           
           
           
           $info .="<table id=\"tabla_info\">";
           $info .= "<tr class=\"avg\"><td>".MESA.":</td><td style=\"border-right: 1px solid #000;\">".$mesa."</td>";
           $info .= "<td class=\"avg\">".COMENSAL.":</td><td style=\"border-right: 1px solid #000;\">".$comensal."</td>";
          
           $suma = 0.00;
//           $total = 0.00;
           $avg_propina = 0.00;
           $avg_descuento = 0.00;
           
           
            while ($a=$bd->obtener_fila($stmt,0)){
                

                
            
               $suma = $suma + (stripslashes($a['pvp']));// * stripslashes($a['cantidad']));
            
               $avg_propina = $a['propina'];
               $avg_descuento = $a['descuento'];
               
            }
                        
            $propina = ($suma * $avg_propina)/100;
            
            //actualizar propina y descuento en historial_puntos
            
            $total = $suma + (($suma * $avg_propina)/100) - (($suma * $avg_descuento)/100);
            
            
            if ($_SESSION["nivel"]=="administrador" || $_SESSION["nivel"]=="encargado"){
                $info .= "<td onclick=\"location.href='propinaydescuento.php?mesa=".$mesa."&comensal=".$comensal."&total=".$total."&avgpropina=".$avg_propina."&avgdescuento=".$avg_descuento."&suma=".$suma."'\">".SUMA.":</td><td style=\"border-right: 1px solid #000;\">".$datos->knumber($suma)."</td><td>".PROPINA.":</td><td style=\"border-right: 1px solid #000;\">".$datos->knumber($propina)."</td><td>".TOTAL.":</td><td id=\"ttotal\">".$datos->knumber($total)."</td></tr></table>";
            }else{
                $info .= "<td>".SUMA.":</td><td id=\"ttotal\">".$datos->knumber($suma)."</td><td>".PROPINA.":</td><td>".$datos->knumber($propina)."</td><td>".TOTAL.":</td><td>".$datos->knumber($total)."</td></tr></table>";
            }

            
            
          
            

        }
       
        return $info;
    }
    

    
     public function c_boton_comensales($mesa) {
       $bd=Db::getInstance();
        
       $ssql = "SELECT comensales.nombre FROM comensales 
           INNER JOIN puntos ON comensales.id_punto = puntos.id_punto 
           WHERE puntos.nombre = '" . $mesa."'";
 

        $stmt=$bd->ejecutar($ssql); 

        $sql = false;
        

        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
                    $sql = true;
                
         }
       
        return $sql;
    }
    
    public function boton_comensales(){
        $sql = '<div id="addcomensal" class="boton_c" onclick="addcom()">  
                 '.CUENTAS.'
           </div>';
        
        return $sql;
    }
    
    public function c_contenido($mesa, $comensal) {
        $bd=Db::getInstance();
        
        $sql = false;
        
        $ssql = "SELECT id_hist_descr FROM historial_puntos_descr INNER JOIN historial_puntos ON
            historial_puntos_descr.id_hist_punto = historial_puntos.id_hist
            WHERE historial_puntos.punto = '".$mesa."' AND historial_puntos.comensal = 
                '".$comensal."' AND historial_puntos.cobrada = 'N' AND 
                    historial_puntos.anulado = 'N'";
        $stmt=$bd->ejecutar($ssql); 
        

               
        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
               
            $sql = true;
        }
        
        return $sql;
    }
}

?>
