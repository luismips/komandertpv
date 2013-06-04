<?php


/**
 * Description of _caja
 *
 * @author root
 */
class _caja {
   public function g_caja_abierta($teclado) {
       include_once('clases/conexion.php');
        $c = new conexion();


       
       $bd=Db::getInstance(); 
        
        $ssql = "SELECT * FROM caja WHERE abierta = 'S'";
        
       $stmt=$bd->ejecutar($ssql);

        $sql = "";
        $sql .= '<div id="container_caja">';
        $sql .= '<table id="tabla_caja">';
        
        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
                while ($a=$bd->obtener_fila($stmt,0)){
                               
                $sql .= '<tr><td>ID CAJA:</td>';
                $sql .= '<td><input type="text" id="tIdCaja" value="'.$a["id_caja"].'"/></td></tr>';
                $sql .= '<tr><td>FECHA:</td>';
                $sql .= '<td><input type="text" id="tFecha" value="'.$a["fecha_ini"].'"/></td></tr>';
                $sql .= '<tr><td>CAMBIO:</td>';
                $sql .= '<td><input type="text" id="tCambio" value="'.$c->knumber($a["cambio"]).'"/></td></tr>';
                $sql .= $this->g_totales($a["id_caja"]);
                $sql .= '<tr><td><div id="bVolver" class="boton" onclick=volver()>VOLVER</div></td>';
                if (!$this->c_mesas_abiertas()){
                    $sql .= '<td><div id="bCerrar" class="boton" onclick=conf_cierre()>CIERRA CAJA</div></td></tr>';
                
                }else{
                    $sql .= '<td></td></tr>';
                
                }
                    
                
            }
            
            
        }else{
            //NO HAY CAJA ABIERTA, BOTON INICIAR CAJA
            $cero = 0.00;
            $sql .= '<tr><td>CAMBIO:</td>';
            if ($teclado == "S"){
                $sql .= '<td><input class="qwerty" type="text" id="tCambio" value="'.$c->knumber($cero).'"/></td></tr>';
            }else{
                $sql .= '<td><input type="text" id="tCambio" value="'.$c->knumber($cero).'"/></td></tr>';
            }
            $sql .= '<tr><td><div id="bVolver" class="boton" onclick=volver()>VOLVER</div></td>';
            $sql .= '<td><div id="bAbrir" class="boton" onclick=abrecaja()>INICIAR CAJA</div></td></tr>';
                
        }
        
        $sql .= '</table>';
        $sql .= '</div>';
        
 
        return $sql;
        
     }
     
     public function g_totales($idcaja) {
         include_once('clases/conexion.php');
        $c = new conexion();
         
         $bd=Db::getInstance(); 
        
       
        $ssql = "SELECT propina, cobro_efectivo, cobro_tarjeta FROM movimientos
            WHERE id_caja = ".$idcaja;
        
        $stmt=$bd->ejecutar($ssql);
        
        $efectivo = 0.00;
        $tarjeta = 0.00;
        $propina = 0.00;
        
        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
                while ($a=$bd->obtener_fila($stmt,0)){
//              $efectivo += number_format($a["cobro_efectivo"], 2 ,'.',',')  ;
//              $tarjeta += number_format($a["cobro_tarjeta"], 2 ,'.',',');
//              $propina += number_format($a["propina"], 2 ,'.',',');
                $efectivo += $a["cobro_efectivo"];
              $tarjeta += $a["cobro_tarjeta"];
              $propina += $a["propina"];
            }
            
        }
        

        $sql = '<tr><td>PROPINA:</td>';
        $sql .= '<td><input type="text" id="tPropina" value="'.$c->knumber($propina).'"/></td></tr>';
        $sql .= '<tr><td>SUBTOTAL:</td>';
        $sql .= '<td><input type="text" id="tSubtotal" value="'.$c->knumber($efectivo + $tarjeta - $propina).'"/></td></tr>';
        $sql .= '<tr><td>EFECTIVO:</td>';
        $sql .= '<td><input type="text" id="tEfectivo" value="'.$c->knumber($efectivo).'"/></td></tr>';
        $sql .= '<tr><td>TARJETA:</td>';
        $sql .= '<td><input type="text" id="tTarjeta" value="'.$c->knumber($tarjeta).'"/></td></tr>';
        $sql .= '<tr><td>TOTAL:</td>';
        $sql .= '<td><input type="text" id="tTotal" value="'.$c->knumber($efectivo + $tarjeta).'"/></td></tr>';
       
        return $sql;
        
     }
     
     public function reinicia_tablas() {
          $bd=Db::getInstance(); 
         
        $ssql = "DELETE FROM cola";        
        $bd->borrar($ssql);
        
        $ssql = "DELETE FROM relacion_visores_cola";        
        $bd->borrar($ssql);

       
        
     }
     
       public function forzar_reinicio() {
        $bd=Db::getInstance(); 
        
        $ssql = "DELETE FROM cola";        
        $bd->borrar($ssql);
        
        $ssql = "DELETE FROM relacion_visores_cola";        
        $bd->borrar($ssql);

        $ssql = "UPDATE historial_puntos SET anulado = 'S'";        
        $bd->actualizar($ssql);
        
        $ssql = "UPDATE puntos SET ocupada = 'N'";        
        $bd->actualizar($ssql);
        
        $ssql = "DELETE FROM cliente_mesa";        
        $bd->borrar($ssql);
        
     }
     
     //comprueba si quedan mesas abiertas para poder cerrar caja
     public function c_mesas_abiertas() {
         $bd=Db::getInstance(); 
        $ssql = "SELECT id_punto FROM puntos WHERE ocupada = 'S'";
        
        $stmt=$bd->ejecutar($ssql);
        
        $sql = false;
        
        if ( $stmt !== false && mysql_num_rows($stmt) > 0 ) {
           
            $sql = true;
            
        }
        
       return $sql;
        
     }
     
     
}

?>
