<?php

/**
 * Description of _cobro
 *
 * @author luismips
 */
class _cobro {
    
    public function cobrar($mesa, $comensal, $tipo, $total, $entregado, $efectivo, $tarjeta, $zona) {
        include_once('_i_historial.php'); 
//        include_once('conexion.php');
//        $datos = new conexion();
        $hist = new _i_historial();
        
       $bd=Db::getInstance(); 
       
       $id_hist = $hist->g_id_hist($mesa, $comensal);
       
       $hora = date("H:i");
       $fecha = date("Y-n-j");
       
       if ($tipo=="E"){
           $efectivo = $total;
       }
       if ($tipo=="T"){
           $tarjeta = $total;
       }
       

        $ssql = "SELECT pvp FROM historial_puntos_descr WHERE id_hist_punto = ".$id_hist." AND 
                            historial_puntos_descr.anulado = 'N'";
        $stmt=$bd->ejecutar($ssql); 

        $suma = 0.00;
        $avgpropina = 0.00;
        $avgdescuento = 0.00;



         if ($stmt !== false && mysql_num_rows($stmt) > 0) {
                while ($a=$bd->obtener_fila($stmt,0)){
                 $suma = $suma + $a['pvp'];
             }
         }      
 
 
        $ssql = "SELECT fecha, hora_apertura, propina, descuento FROM historial_puntos WHERE id_hist = ".$id_hist;
        $stmt2=$bd->ejecutar($ssql);

        $fecha_a;
        $hora_a;

         if ( $stmt2 !== false && mysql_num_rows($stmt2) > 0 ) {
             while ( $b = $bd->obtener_fila($stmt2,0) ) {
                 $avgpropina = $b['propina'];
                 $avgdescuento = $b['descuento'];
                 $fecha_a = $b['fecha'];
                $hora_a = $b['hora_apertura'];
             }
         } 
         $propina = ($suma * $avgpropina)/100;//$datos->parse_decimal(($suma * $avgpropina)/100);
         $descuento = ($suma * $avgdescuento)/100;//$datos->parse_decimal(($suma * $avgdescuento)/100);


     $ssql ="INSERT INTO movimientos (id_caja, id_hist, punto, comensal, fecha_ini, 
           hora_ini, fecha_fin, hora_fin, tipo_cobro, total, entregado, cobro_efectivo, 
           cobro_tarjeta, invitacion, motivo_invitacion, observ, propina, descuento) VALUES (
           (SELECT id_caja FROM caja WHERE abierta = 'S'), 
           ".$id_hist.",
           '".$mesa."', '".$comensal."', '".$fecha_a."', '".$hora_a."',
           
            '".$fecha."', '".$hora."', '".$tipo."', ".$total.", ".$entregado.", ".$efectivo.",
                ".$tarjeta.", 'N', '', '', ".$propina.",".$descuento."
                    )";
    
       $bd->insertar($ssql);
       
       //TODO OJOOOOO HAy ke poner fecha y hora fin en hist_puntos
        
//        -----------------------------------------------
        //cierra historial 
        $cobrado = "UPDATE historial_puntos SET cobrada = 'S'
               WHERE id_hist = ".$id_hist;
        $bd->insertar($cobrado);  
           
        //borra de la tabla cliente_mesa por si esta abierta
        $del = "DELETE FROM cliente_mesa WHERE id_mesa = (SELECT id_punto FROM puntos WHERE nombre = '".$mesa."') 
            AND comensal = '".$comensal."'"; 
        $bd->borrar($del);   
           
        //comprueba si kedan comensales para cerrar la mesa
          $ssql = "SELECT comensal FROM historial_puntos WHERE punto = '".$mesa."' AND
    cobrada = 'N' AND anulado = 'N'";
            
           $stmt3=$bd->ejecutar($ssql); 
        
           if ( mysql_num_rows($stmt3) == 0 ){
                //desocupa punto
               $desocupa = "UPDATE puntos SET ocupada = 'N' WHERE nombre ='".$mesa."'";
               $bd->actualizar($desocupa);   
           }
        
         //borra claves acceso de la mesa
           $delclave = "DELETE FROM cliente_mesa 
               WHERE id_mesa = (SELECT id_punto FROM puntos WHERE nombre ='".$mesa."') 
                   AND comensal ='".$comensal."'";
           $bd->borrar($delclave);
     
         if (($_SESSION["tipo_zona"]=="LLEVAR") || ($_SESSION["tipo_zona"]=="REPARTO")){
              $delpunto = "DELETE FROM puntos WHERE nombre = '".$mesa."'";
              $bd->borrar($delpunto); 
       }
       
    }
    
    
    public function cobrar_todo($mesa, $comensal, $tipo, $total, $entregado, $efectivo, $tarjeta, $zona) {
        $bd=Db::getInstance(); 
        
        $id_hist = "";
        
       
       //obtener id_hist del primer comensal
        $ssql = "SELECT id_hist FROM historial_puntos WHERE punto = '".$mesa."' 
            AND cobrada = 'N' AND anulado = 'N' LIMIT 1";
        $stmt=$bd->ejecutar($ssql);
          if ($stmt !== false && mysql_num_rows($stmt) > 0) {
                while ($a=$bd->obtener_fila($stmt,0)){
                 $id_hist = $a['id_hist'];
             }
         }          
        
       //sustituir los id_hist_punto del resto de comensales QUE NO ESTEN COBRADOS
         //NI ANULADOS
       $ssql = "SELECT id_hist_descr FROM historial_puntos_descr INNER JOIN 
           historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
           WHERE historial_puntos.punto = '".$mesa."' 
            AND historial_puntos.cobrada = 'N' AND historial_puntos.anulado = 'N'";
        $stmt=$bd->ejecutar($ssql);
            if ($stmt !== false && mysql_num_rows($stmt) > 0) {
                while ($a=$bd->obtener_fila($stmt,0)){
                 $upd = "UPDATE historial_puntos_descr SET id_hist_punto = ".$id_hist." 
                     WHERE id_hist_descr = ".$a['id_hist_descr'];
                 $bd->actualizar($upd);
             }
            
         }    
        
        
       //eliminar los id_hist de historial_puntos y dejar solo 1 con todo
       $del = "DELETE FROM historial_puntos WHERE id_hist <> ".$id_hist." AND 
           punto = '".$mesa."' AND cobrada = 'N' AND anulado = 'N'";
       
       $bd->borrar($del);
       
       $hora = date("H:i");
       $fecha = date("Y-n-j");
       
       if ($tipo=="E"){
           $efectivo = $total;
       }
       if ($tipo=="T"){
           $tarjeta = $total;
       }
       
       
$ssql = "SELECT pvp FROM historial_puntos_descr WHERE id_hist_punto = ".$id_hist." AND 
                    historial_puntos_descr.anulado = 'N'";
 $stmt=$bd->ejecutar($ssql);
           
   
$suma = 0.00;
$avgpropina = 0.00;
$avgdescuento = 0.00;
//$propina = 0.00;
//$descuento = 0.00;

  if ($stmt !== false && mysql_num_rows($stmt) > 0) {
                while ($a=$bd->obtener_fila($stmt,0)){
         $suma = $suma + $a['pvp'];
     }
     
 }      
   
$ssql = "SELECT fecha, hora_apertura, propina, descuento FROM historial_puntos WHERE id_hist = ".$id_hist;
$stmt=$bd->ejecutar($ssql);

  if ($stmt !== false && mysql_num_rows($stmt) > 0) {
                while ($b=$bd->obtener_fila($stmt,0)){
         $avgpropina = $b['propina'];
         $avgdescuento = $b['descuento'];
           $fecha_a = $b['fecha'];
        $hora_a = $b['hora_apertura'];
     }
     
 } 
 $propina = ($suma * $avgpropina)/100;
 $descuento = ($suma * $avgdescuento)/100;
// $sumatotal = $suma + (($suma * $avgpropina)/100) - (($suma * $avgdescuento)/100);
       
       $ssql ="INSERT INTO movimientos (id_caja, id_hist, punto, comensal, fecha_ini, 
           hora_ini, fecha_fin, hora_fin, tipo_cobro, total, entregado, cobro_efectivo, 
           cobro_tarjeta, invitacion, motivo_invitacion, observ, propina, descuento) VALUES (
           (SELECT id_caja FROM caja WHERE abierta = 'S'), 
           ".$id_hist.",
           '".$mesa."', '".$comensal."', '".$fecha_a."', '".$hora_a."',
        
            '".$fecha."', '".$hora."', '".$tipo."', ".$total.", ".$entregado.", ".$efectivo.",
                ".$tarjeta.", 'N', '', '', ".$propina.",".$descuento."
                    )";
    
      $bd->insertar($ssql);
       
       //TODO OJOOOOO HAy ke poner fecha y hora fin en hist_puntos
        
//        -----------------------------------------------
        //cierra historial 
        $cobrado = "UPDATE historial_puntos SET cobrada = 'S'
               WHERE id_hist = ".$id_hist;
         $bd->actualizar($cobrado);
           
        
        //comprueba si kedan comensales para cerrar la mesa
          $ssql = "SELECT comensal FROM historial_puntos WHERE punto = '".$mesa."' AND
    cobrada = 'N' AND anulado = 'N'";
            
          $stmt=$bd->ejecutar($ssql);

          if (mysql_num_rows($stmt) == 0) {
                
                //desocupa punto
               $desocupa = "UPDATE puntos SET ocupada = 'N' WHERE nombre ='".$mesa."'";
               $bd->actualizar($desocupa);
           }
           
           //borra claves acceso de la mesa
           $delclave = "DELETE FROM cliente_mesa 
               WHERE id_mesa = (SELECT id_punto FROM puntos WHERE nombre ='".$mesa."') 
                   AND comensal ='".$comensal."'";
           $bd->borrar($delclave);
        
     
        if (($_SESSION["tipo_zona"]=="LLEVAR") || ($_SESSION["tipo_zona"]=="REPARTO")){
              $delpunto = "DELETE FROM puntos WHERE nombre = '".$mesa."'";
              $bd->borrar($delpunto);
       }
     
    }
}

?>
