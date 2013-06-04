<?php

/**
 * Description of _log
 *
 * @author luismips
 */
class _log {
     public function add_log($usuario, $operacion, $detalles) {
         
        $bd=Db::getInstance();
        $fecha = date("Y-n-j");
        $hora = date("H:i");

            
           $ssql = "INSERT INTO log (fecha, hora, usuario, ip, operacion, detalles) VALUES 
               ('".$fecha."', '".$hora."', '".$usuario."', '".$_SERVER["REMOTE_ADDR"]."', '".$operacion."', '".$detalles."')";
           
           $bd->insertar($ssql);
      
    }
}

?>
