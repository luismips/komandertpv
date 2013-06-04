<?php


/**
 * Description of _eliminamesa
 *
 * @author luismips
 */


class _borracomanda {
  
    public function borracomanda($mesa, $comensal, $zona) {
        
       $bd=Db::getInstance();  
 
           $ssql = "SELECT id_hist_descr FROM historial_puntos_descr 
               INNER JOIN historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
               WHERE historial_puntos.punto = '".$mesa."' AND 
                   historial_puntos.comensal = '".$comensal."' AND 
                   historial_puntos.cobrada = 'N' AND 
                   historial_puntos.anulado = 'N'";
           
            $stmt=$bd->ejecutar($ssql); 

        
            $sql = "";

            if ($stmt !== false && mysql_num_rows($stmt) > 0) {
                while ($a=$bd->obtener_fila($stmt,0)){
                        $upd = "UPDATE cola SET anulado='S' WHERE id_hist_descr = ".$a['id_hist_descr'];
                        $bd->actualizar($upd);
                        $upd = "UPDATE historial_puntos_descr SET anulado='S' WHERE id_hist_descr = ".$a['id_hist_descr'];
                        $bd->actualizar($upd);
                    }
             }
             
             //borra comensal
             $upd = "UPDATE historial_puntos SET anulado = 'S' 
                 WHERE punto ='".$mesa."' AND 
                    comensal = '".$comensal."' AND cobrada ='N' AND anulado = 'N'";
             $bd->actualizar($upd);
             
             //comprueba si existen mas comensales en esa mesa
             $ssql = "SELECT comensal FROM historial_puntos WHERE punto = '".$mesa."' AND
    cobrada = 'N' AND anulado = 'N'";
            
            $stmt=$bd->ejecutar($ssql); 


            if ( $stmt !== true && mysql_num_rows($stmt) == 0 ) {
              
               //Marca punto como libre
               $updpunto = "UPDATE puntos SET ocupada = 'N' WHERE nombre = '".$mesa."'";
               $bd->actualizar($updpunto);

            }
           //borra claves acceso de la mesa
           $delclave = "DELETE FROM cliente_mesa 
               WHERE id_mesa = (SELECT id_punto FROM puntos WHERE nombre ='".$mesa."') 
                   AND comensal ='".$comensal."'";
           $bd->borrar($delclave);
           
//       } 
          
       if (($_SESSION["tipo_zona"]=="LLEVAR") || ($_SESSION["tipo_zona"]=="REPARTO")){
              $delpunto = "DELETE FROM puntos WHERE nombre = '".$mesa."'";
              $bd->borrar($delpunto);
       }   
           
        

        return $sql;
        
    }
}

?>
