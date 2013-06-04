<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of _cambionombre
 *
 * @author luismips
 */
class _cambionombre {
     public function cambio_nombre($mesa, $comensal, $nuevo) {
        $bd=Db::getInstance();
 
          
           //cambia nombre en historial puntos
           $ssql = "UPDATE historial_puntos SET comensal = '".$nuevo."' 
               WHERE comensal = '".$comensal."' AND punto = '".$mesa."' AND 
                   cobrada = 'N' AND anulado = 'N'";
           $bd->actualizar($ssql);
           
           
           //modifica comensal en cola y hist_descr
           $ssql = "SELECT historial_puntos_descr.id_hist_descr FROM historial_puntos_descr INNER JOIN 
               historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
                WHERE historial_puntos.punto = '".$mesa."' AND 
               historial_puntos_descr.comensal ='".$comensal."' AND historial_puntos.cobrada = 'N' AND historial_puntos.anulado = 'N'";
           $stmt=$bd->ejecutar($ssql); 

           if ($stmt !== false && mysql_num_rows($stmt) > 0) {
                while ($a=$bd->obtener_fila($stmt,0)){
                        $upd = "UPDATE cola SET comensal='".$nuevo."' WHERE id_hist_descr = ".$a['id_hist_descr'];
                       $bd->actualizar($upd);
                        $upd = "UPDATE historial_puntos_descr SET comensal='".$nuevo."' WHERE id_hist_descr = ".$a['id_hist_descr'];
                        $bd->actualizar($upd);
                    }
             }

        
        
    }
}

?>
