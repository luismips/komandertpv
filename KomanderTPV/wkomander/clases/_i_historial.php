<?php

/**
 * Description of _i_historial
 *
 * @author luismips
 */
class _i_historial {
    
    public function c_ocupado($mesa) {
        $bd=Db::getInstance();  
        
       $ssql = "SELECT ocupada FROM puntos WHERE nombre = '" . $mesa."'";
 

        $stmt=$bd->ejecutar($ssql); 
        
        $sql = false;
        
        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
            while ($a=$bd->obtener_fila($stmt,0)){
               if ($a['ocupada']=='N'){
                    $sql = false;
                }else{
                    $sql = true;
                }
           }
        }

        return $sql;
    }
    
     public function c_mods($idarticulo) {
        $bd=Db::getInstance();
        
       $ssql = "SELECT arts_grupomods.id_grupo FROM arts_grupomods
           INNER JOIN articulos ON arts_grupomods.id_art = articulos.id_articulo
            WHERE articulos.id_articulo = ". $idarticulo;
 

        $stmt=$bd->ejecutar($ssql); 

        $sql = false;
        

        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
           
                    $sql = true;
              
        }
      
        return $sql;
    }
 
 public function g_id_hist($mesa, $comensal) {
       $bd=Db::getInstance();
        
       $ssql = "SELECT id_hist FROM historial_puntos 
           WHERE cobrada = 'N' AND anulado = 'N' AND punto ='".$mesa."' AND comensal = '".$comensal."'";
            

        $stmt=$bd->ejecutar($ssql); 

        $sql = "";
        

         if ($stmt !== false && mysql_num_rows($stmt) > 0) {
            while ($a=$bd->obtener_fila($stmt,0)){
               
                 $sql = $a['id_hist'];
                    
              }
        }

        return $sql;
    }
    
    
 public function c_hist_descr($mesa, $comensal, $articulo, $mods) {
        $bd=Db::getInstance();
        
         $ssql = "SELECT id_hist_descr FROM historial_puntos_descr 
            INNER JOIN historial_puntos ON historial_puntos_descr.id_hist_punto =
            historial_puntos.id_hist
            WHERE historial_puntos.punto = '" . $mesa."' AND 
            historial_puntos.comensal = '".$comensal."' AND
            historial_puntos_descr.articulo = '".$articulo."' AND
            historial_puntos_descr.mods = '".$mods."' AND
            historial_puntos_descr.enviado = 'N' AND 
            historial_puntos_descr.anulado = 'N' AND 
            historial_puntos.cobrada = 'N' AND 
            historial_puntos.anulado = 'N'";
       

        $stmt=$bd->ejecutar($ssql); 

        $sql = "";
        

        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
            while ($a=$bd->obtener_fila($stmt,0)){
               
                 $sql = $a['id_hist_descr'];
                    
              }
        }
        
        return $sql;
    }
    
  public function ocupar_mesa($mesa) {
        $bd=Db::getInstance();
        
        $ssql = "UPDATE puntos SET ocupada = 'S' WHERE nombre = '" . $mesa."'";
 

       $bd->actualizar($ssql); 

   }
    
 public function suma_uno($id_hist, $idarticulo) {
        $bd=Db::getInstance();
        
            $ssql = "UPDATE historial_puntos_descr SET cantidad = cantidad +1,
                pvp = pvp + (SELECT pvp FROM articulos WHERE id_articulo = ".$idarticulo.")
                WHERE id_hist_descr = " . $id_hist;

         $bd->actualizar($ssql); 

    }
    
     public function suma_uds_conmods($id_hist, $idarticulo, $pvpmods, $uds) {
        $bd=Db::getInstance();

            $ssql = "UPDATE historial_puntos_descr SET cantidad = cantidad + ".$uds.",
                pvp = pvp + ((".$pvpmods." + (SELECT pvp FROM articulos WHERE id_articulo = ".$idarticulo.")) * ".$uds.")
                WHERE id_hist_descr = " . $id_hist;

           $bd->actualizar($ssql); 

    }
    
  public function nuevo_historial($mesa, $comensal) {
       
         $bd=Db::getInstance();
          
        $fecha = date("Y-n-j");
        $hora = date("H:i");
        
       $ssql = "INSERT INTO historial_puntos (fecha, fecha_fin, hora_apertura, hora_cierre,
           punto, comensal, cobrada, anulado, propina, descuento, usuario) VALUES 
           ('".$fecha."', '0000-00-00', '".$hora."', '00:00','".$mesa."', '".$comensal."', 'N', 'N', "._PROPINA_.", "._DESCUENTO_.", '".$_SESSION["usuario"]."')";
       
        $bd->insertar($ssql); 
 
    }
    
    public function i_hist_descr($mesa, $comensal, $articulo, $usuario, $mods, $uds, $preciomods, $zona, $idarticulo, $ids_mods) {
        $bd=Db::getInstance();
       
        $hora = date("H:i");
        
        
        if (($_SESSION["tipo_zona"]=="LLEVAR") || ($_SESSION["tipo_zona"]=="REPARTO")){
            $llevar = "S";
                          $ssql = "INSERT INTO historial_puntos_descr (id_hist_punto, comensal, idarticulo, articulo,
           cantidad, pvp, usuario, hora, invitacion, enviado, anulado, llevar, mods, observ, mods_lang) VALUES 
           ((SELECT id_hist FROM historial_puntos WHERE punto='".$mesa."' AND
               comensal='".$comensal."' AND cobrada = 'N' AND anulado = 'N'), '".$comensal."',".$idarticulo.", '".$articulo."', ".$uds.",
                   ((SELECT pvp FROM articulos WHERE id_articulo = ".$idarticulo.") + ".$preciomods." + 
                       (SELECT cargo_llevar FROM articulos WHERE id_articulo = ".$idarticulo.")) * ".$uds.",
                       '".$usuario."', '".$hora."', 'N', 'N', 'N','".$llevar."' , '".$mods."', '', '".$ids_mods."')";
        }else{
            $llevar = "N";
                          $ssql = "INSERT INTO historial_puntos_descr (id_hist_punto, comensal, idarticulo, articulo,
           cantidad, pvp, usuario, hora, invitacion, enviado, anulado, llevar, mods, observ, mods_lang) VALUES 
           ((SELECT id_hist FROM historial_puntos WHERE punto='".$mesa."' AND
               comensal='".$comensal."' AND cobrada = 'N' AND anulado = 'N'), '".$comensal."', ".$idarticulo.", '".$articulo."', ".$uds.",
                   ((SELECT pvp FROM articulos WHERE id_articulo = ".$idarticulo.") + ".$preciomods.") * ".$uds.",
                       '".$usuario."', '".$hora."', 'N', 'N', 'N','".$llevar."' , '".$mods."', '', '".$ids_mods."')";
        }
        
      

        $bd->insertar($ssql); 
    }
}

?>
