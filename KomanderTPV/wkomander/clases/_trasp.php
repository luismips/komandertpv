<?php


/**
 * Description of _trasp
 *
 * @author luismips
 */
class _trasp {
   public function panel_destino() {
         
       $bd=Db::getInstance(); 
       
       $ssql = "SELECT nombre FROM puntos ORDER BY nombre ASC";
        
       $rs = $bd->ejecutar($ssql);

        $sql = "<div id=\"datos_destino\">";
        $sql .= "<table id=\"tabla_m_destino\">";
        $sql .= "<tr><td>".M2.":</td></tr>";
        $sql .= "<tr><td>";
        $sql .= "<select id=\"mesa_destino\" onchange=\"set_m_destino()\">";
        
        
        if ($rs !== false && mysql_num_rows($rs) > 0) {
           while ( $a = $bd->obtener_fila($rs,0)){
//               $mesa_destino[$i]=$a['nombre'];
               $sql .= "<option value=\"".$a['nombre']."\">".$a['nombre']."</option>";
//               $i++;
               
           }
           
        }
        
        $sql .= "</select></td></tr></table></div>";
      
        
    return $sql;
  }
  
  public function panel_com_destino($mesa) {
         
        $bd=Db::getInstance(); 
        
        $ssql = "SELECT comensal FROM historial_puntos WHERE 
           punto = '".$mesa."' AND cobrada = 'N' AND anulado = 'N' ORDER BY comensal ASC";

        $rs = $bd->ejecutar($ssql);

       $sql = "";
           $sql .= "<div id=\"com_destino\">";
                $sql .= "<table id=\"tabla_c_destino\">";
                $sql .= "<tr><td>".C2.":</td></tr>";
                $sql .= "<tr><td>";
                $sql .= "<select id=\"comensal_destino\" onchange=\"set_c_destino()\">";

       
        if ($rs !== false && mysql_num_rows($rs) > 0) {
               
          
          
           while ( $a = $bd->obtener_fila($rs,0)){
               $sql .= "<option value=\"".$a['comensal']."\">".$a['comensal']."</option>";
           }
           
                 
           
           
        } 
        else {
                $sql .= "<option selected=\"selected\" value=\"1\">1</option>";
        }
        
        $sql .= "</tr></td>";
                $sql .= "</select>";
                $sql .= "</table>";
                $sql .= "</div>";
        
        
      
        return $sql;
  }
  
 public function traspasar($mesa, $comensal, $mdest, $cdest) {

    $this->traspasa_comensal_a_comensal($mesa, $comensal, $mdest, $cdest);

 }

  public function traspasa_punto_a_punto($mesa, $mdest){
       
        $bd=Db::getInstance(); 
        
        //Si no esta ocupado el punto de destino, lo inicia
        $hist = new _i_historial();

        if (!$hist->c_ocupado($mdest)){
            $hist->ocupar_mesa($mdest);
        }
        
        $id_hist_origen = $hist->g_id_hist($mesa);
        $id_hist_dest = $hist->g_id_hist($mdest);
        
         //obtiene el historial_puntos_descr para el id_hist origen
        $ssql = "SELECT * FROM historial_puntos_descr 
            WHERE id_hist_punto=".$id_hist_origen;
        
        $rs = $bd->ejecutar($ssql);
        
        if ($rs !== false && mysql_num_rows($rs) > 0) {
           while ( $a = $bd->obtener_fila($rs,0)){
               
             // modifica id_hist_punto con el nuevo_historial
              $upddescr= "UPDATE historial_puntos_descr 
                  SET id_hist_punto=".$id_hist_dest." 
                      WHERE id_hist_descr=".$a['id_hist_descr'];
              
              $bd->actualizar($upddescr);
              
             // modifica el punto en la cola
               
             $updcola = "UPDATE cola SET mesa='".$mdest."', comensal='0' WHERE id_hist_descr=".$a['id_hist_descr']; 
               
             $bd->actualizar($updcola);
             
             //modifica traspaso en cola
              $updc="UPDATE cola SET traspaso='S', punto_anterior='".$mesa."' WHERE 
                  id_hist_descr=".$a['id_hist_descr'];
              
             $bd->actualizar($updc);
              
              
              // modificar tb el id_visor en relacion_visores_cola
             //NO NECESITA MODIFICAR SI SE AÑADE NUEVA COLA, revisar
              $pt = new _pte();
              $pt->relacion_visores_cola($a['articulo'], $mesa, $a['id_hist_descr']);
           }
           
           //Desocupa punto
           $desocupa = "UPDATE puntos SET ocupada='N' WHERE nombre ='".$mesa."'";
           $bd->actualizar($desocupa);
           
            //Anula id_hist
           $anula = "UPDATE historial_puntos SET anulado='S' WHERE id_hist=".$id_hist_origen;
           $bd->actualizar($anula);
        }
        
     }
     
     public function traspasa_punto_a_comensal($mesa, $mdest, $cdest){
       $bd=Db::getInstance(); 
       //Si no esta ocupado el punto de destino, lo inicia
        $hist = new _i_historial();

        if (!$hist->c_ocupado($mdest)){
            $hist->nuevo_historial($mdest);
            $hist->ocupar_mesa($mdest);
        }
        
        $id_hist_origen = $hist->g_id_hist($mesa);
        $id_hist_dest = $hist->g_id_hist($mdest);
        
        //obtiene el historial_puntos_descr para el id_hist origen
        $ssql = "SELECT * FROM historial_puntos_descr 
            WHERE id_hist_punto=".$id_hist_origen;
        
        $rs = $bd->ejecutar($ssql);
        
        if ($rs !== false && mysql_num_rows($rs) > 0) {
           while ( $a = $bd->obtener_fila($rs,0)){
               
             // modifica id_hist_punto con el nuevo_historial
              $upddescr= "UPDATE historial_puntos_descr 
                  SET id_hist_punto=".$id_hist_dest.", comensal = '".$cdest."' 
                      WHERE id_hist_descr=".$a['id_hist_descr'];
              
              $bd->actualizar($upddescr);
              
             // modifica el punto en la cola
               
             $updcola = "UPDATE cola SET mesa='".$mdest."', comensal='".$cdest."' WHERE id_hist_descr=".$a['id_hist_descr']; 
               
             $bd->actualizar($updcola);
             
             //modifica traspaso en cola
              $updc="UPDATE cola SET traspaso='S', punto_anterior='".$mesa."' WHERE 
                  id_hist_descr=".$a['id_hist_descr'];
              
             $bd->actualizar($updc);
              
              
              // modificar tb el id_visor en relacion_visores_cola
             //NO NECESITA MODIFICAR SI SE AÑADE NUEVA COLA, revisar
              $pt = new _pte();
              $pt->relacion_visores_cola($a['articulo'], $mesa, $a['id_hist_descr']);
           }
           
           //Desocupa punto
           $desocupa = "UPDATE puntos SET ocupada='N' WHERE nombre ='".$mesa."'";
           $bd->actualizar($desocupa);
           
            //Anula id_hist
           $anula = "UPDATE historial_puntos SET anulado='S' WHERE id_hist=".$id_hist_origen;
           $bd->actualizar($anula);
        }
     }
     
     public function traspasa_comensal_a_punto($mesa, $comensal, $mdest){
        $bd=Db::getInstance(); 
        //Si no esta ocupado el punto de destino, lo inicia
        $hist = new _i_historial();

        if (!$hist->c_ocupado($mdest)){
            $hist->nuevo_historial($mdest);
            $hist->ocupar_mesa($mdest);
        }
        
        $id_hist_origen = $hist->g_id_hist($mesa);
        $id_hist_dest = $hist->g_id_hist($mdest);
        
        //obtiene el historial_puntos_descr para el id_hist origen
        $ssql = "SELECT * FROM historial_puntos_descr 
            WHERE id_hist_punto=".$id_hist_origen." AND 
                comensal = '".$comensal."'";
        
        $rs = $bd->ejecutar($ssql);
        
        if ($rs !== false && mysql_num_rows($rs) > 0) {
           while ( $a = $bd->obtener_fila($rs,0)){
               
             // modifica id_hist_punto con el nuevo_historial
              $upddescr= "UPDATE historial_puntos_descr 
                  SET id_hist_punto=".$id_hist_dest.", comensal = '0' 
                      WHERE id_hist_descr=".$a['id_hist_descr'];
              
              $bd->actualizar($upddescr);
              
             // modifica el punto en la cola
               
             $updcola = "UPDATE cola SET mesa='".$mdest."', comensal='0' WHERE id_hist_descr=".$a['id_hist_descr']; 
               
             $bd->actualizar($updcola);
             
             //modifica traspaso en cola
              $updc="UPDATE cola SET traspaso='S', punto_anterior='".$mesa.".".$comensal."' WHERE 
                  id_hist_descr=".$a['id_hist_descr'];
              
              $bd->actualizar($updc);
              
              
              // modificar tb el id_visor en relacion_visores_cola
             //NO NECESITA MODIFICAR SI SE AÑADE NUEVA COLA, revisar
              $pt = new _pte();
              $pt->relacion_visores_cola($a['articulo'], $mesa, $a['id_hist_descr']);
           }
           
           // Elimina comensal
           $delcom = "DELETE FROM comensales 
               WHERE nombre ='".$comensal."' AND id_punto = 
                   (SELECT id_punto FROM puntos WHERE nombre = '".$mesa."')";
           $bd->borrar($delcom);
           
           
           //comprueba si kedan comensales, si no kedan anula y desocupa punto
           $check = "SELECT comensales.nombre FROM comensales 
               INNER JOIN puntos ON comensales.id_punto = puntos.id_punto
                WHERE puntos.nombre='".$mesa."'";
           

            $rs2 = $bd->ejecutar($check);


            if ( $rs2 !== false && mysql_num_rows($rs2) > 0 ) {
                   //Desocupa punto
               $desocupa = "UPDATE puntos SET ocupada='N' WHERE nombre ='".$mesa."'";
               $bd->actualizar($desocupa);

                //Anula id_hist
               $anula = "UPDATE historial_puntos SET anulado='S' WHERE id_hist=".$id_hist_origen;
               $bd->actualizar($anula);

            }
          
        }
     
     }
     
     public function traspasa_comensal_a_comensal($mesa, $comensal, $mdest, $cdest){
        $bd=Db::getInstance(); 
        //Si no esta ocupado el punto de destino, lo inicia
        $hist = new _i_historial();

        if (!$hist->c_ocupado($mdest)){
            $hist->ocupar_mesa($mdest);
        }
        
        $id_hist_origen = $hist->g_id_hist($mesa, $comensal);
        $id_hist_dest = $hist->g_id_hist($mdest, $cdest);
        
        if ($id_hist_dest == ""){
            $hist->nuevo_historial($mdest, $cdest);
            $id_hist_dest = $hist->g_id_hist($mdest, $cdest);
        }
                
        //obtiene el historial_puntos_descr para el id_hist origen
        $ssql = "SELECT * FROM historial_puntos_descr 
            WHERE id_hist_punto=".$id_hist_origen;
        
        $rs = $bd->ejecutar($ssql);
        
        if ($rs !== false && mysql_num_rows($rs) > 0) {
           while ( $a = $bd->obtener_fila($rs,0)){
               
             // modifica id_hist_punto con el nuevo_historial
              $upddescr= "UPDATE historial_puntos_descr 
                  SET id_hist_punto=".$id_hist_dest." 
                      WHERE id_hist_descr=".$a['id_hist_descr'];
               $bd->actualizar($upddescr);
              
             // modifica el punto en la cola
             $updcola = "UPDATE cola SET mesa='".$mdest."', comensal='".$cdest."' WHERE id_hist_descr=".$a['id_hist_descr']; 
              $bd->actualizar($updcola);
             
             //modifica traspaso en cola
              $updc="UPDATE cola SET traspaso='S', punto_anterior='".$mesa.".".$comensal."' WHERE 
                  id_hist_descr=".$a['id_hist_descr'];
              
              $bd->actualizar($updc);
                            
              // modificar tb el id_visor en relacion_visores_cola
             //NO NECESITA MODIFICAR SI SE AÑADE NUEVA COLA, revisar
              $pt = new _pte();
              $pt->relacion_visores_cola($a['articulo'], $mesa, $a['id_hist_descr']);
           }
           
           // Pone historial_punto anulado
           $delcom = "UPDATE historial_puntos SET anulado = 'S'
               WHERE id_hist =".$id_hist_origen;
            $bd->actualizar($delcom);
           
           
             //comprueba si kedan comensales para cerrar la mesa
          $ssql = "SELECT comensal FROM historial_puntos WHERE punto = '".$mesa."' AND
    cobrada = 'N' AND anulado = 'N'";
            
           $rs = $bd->ejecutar($ssql);
        
           if ( mysql_num_rows($rs) == 0 ){
                //desocupa punto
               $desocupa = "UPDATE puntos SET ocupada = 'N' WHERE nombre ='".$mesa."'";
               $bd->actualizar($desocupa);
           }
          
        }
     }
}

?>
